<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Hash, Storage, Gate, Auth
};

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users',
            'surname'       => 'required|string|max:255',
            'password'      => 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->hasFile('profile_image')
            ? $request->file('profile_image')->store('profile_images', 'public')
            : 'profile_images/default.jpg';

        User::create([
            'name'          => $validated['name'],
            'username'      => $validated['username'],
            'surname'       => $validated['surname'],
            'password'      => Hash::make($validated['password']),
            'profile_image' => $imagePath,
        ]);

        return redirect()
            ->route('createUsers')
            ->with('success', 'User created successfully!');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        Gate::authorize('access-admin-features');
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('access-admin-features');

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username,' . $user->id,
            'surname'       => 'required|string|max:255',
            'password'      => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_admin'      => 'boolean',
        ]);

        $data = [
            'name'     => $validated['name'],
            'username' => $validated['username'],
            'surname'  => $validated['surname'],
            'is_admin' => $request->boolean('is_admin'),
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('profile_image')) {
            if (
                $user->profile_image &&
                $user->profile_image !== 'profile_images/default.jpg' &&
                Storage::disk('public')->exists($user->profile_image)
            ) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $data['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user->update($data);

        return redirect()
            ->route('usersShow', $user)
            ->with('success', 'Utente aggiornato con successo!');
    }

public function destroy(User $user)
    {
        Gate::authorize('access-admin-features');

        if ($user->profile_image && $user->profile_image !== 'profile_images/default.jpg' && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $user->delete();

        return redirect()->route('users.index')->with('warning', 'Utente eliminato con successo!');
    }
}
