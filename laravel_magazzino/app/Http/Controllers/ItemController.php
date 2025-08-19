<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
public function index(Request $request)
{
    $query = Item::with('user');

    if ($request->has('search')) {
        $searchTerms = explode(' ', $request->input('search'));
        $query->where(function ($q) use ($searchTerms) {
            foreach ($searchTerms as $term) {
                $q->orWhere('description', 'like', '%' . $term . '%');
            }
        });
    }
    $items = $query->get();

    return view('articles.index', compact('items'));
}
    public function create()
    {
        $user = Auth::user();
        return view('articles.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'item_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|string|max:3',
        ]);

        $item = new Item();
        $item->title = $request->title;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->user_id = Auth::id();

        if ($request->hasFile('item_image')) {
            $item->item_image = $request->file('item_image')->store('articles_images', 'public');
        } else {
            $item->item_image = 'articles_images/default.png';
        }

        $item->save();

        return redirect()->route('createItem')->with('success', 'Articolo creato con successo.');
    }

    public function show(Item $item)
    {
        $item->load('user');
        return view('articles.show', compact('item'));
    }

    public function edit(Item $item)
    {
        //
    }

    public function update(Request $request, Item $item)
    {
        //
    }

    public function destroy(Item $item)
    {
        //
    }

}