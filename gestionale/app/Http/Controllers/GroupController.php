<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    protected $backupService;

    public function __construct(\App\Services\BackupService $backupService)
    {
        $this->backupService = $backupService;
    }

    public function create()
    {
        $rooms = config('rooms');
        return view('groups.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'arrival_date' => 'required|date|after_or_equal:today',
            'departure_date' => 'required|date|after:arrival_date',
            'rooms' => 'required|array|min:1',
            'rooms.*' => 'required',
            'pax' => 'nullable|integer|min:0',
            'notes' => 'nullable|string'
        ]);

        $groupId = (string) Str::uuid();
        $groupName = $request->description;

        DB::beginTransaction();
        try {
            $arrival = Carbon::parse($request->arrival_date);
            $departure = Carbon::parse($request->departure_date);

            // Controllo disponibilità camere
            $occupied = Customer::whereIn('room_number', $request->rooms)
                ->where(function ($q) use ($arrival, $departure) {
                    $q->where('arrival_date', '<', $departure->format('Y-m-d'))
                        ->where('departure_date', '>', $arrival->format('Y-m-d'));
                })->exists();

            if ($occupied) {
                return back()->withInput()->withErrors(['rooms' => 'Una o più camere selezionate sono occupate nel periodo scelto.']);
            }

            $totalPax = $request->pax ?? 0;
            $numRooms = count($request->rooms);
            $basePax = intdiv($totalPax, $numRooms);
            $remainder = $totalPax % $numRooms;

            // Evita N backup consecutivi sospendendo gli eventi durante il loop
            Customer::withoutEvents(function () use ($request, $groupName, $groupId, $basePax, $remainder) {
                foreach ($request->rooms as $index => $roomNumber) {
                    $paxForThisRoom = $basePax + ($index < $remainder ? 1 : 0);
                    
                    Customer::create([
                        'first_name' => $groupName,
                        'last_name' => '(Gruppo)',
                        'email' => null,
                        'phone' => null,
                        'room_number' => $roomNumber,
                        'arrival_date' => $request->arrival_date,
                        'departure_date' => $request->departure_date,
                        'treatment' => 'BB',
                        'pax' => $paxForThisRoom,
                        'under_12_pax' => 0,
                        'total_price' => 0,
                        'deposit' => 0,
                        'payment_method' => 'cash',
                        'notes' => $request->notes,
                        'group_id' => $groupId,
                        'group_name' => $groupName,
                    ]);
                }
            });

            $this->backupService->createBackup('autosave_backup.sql');

            DB::commit();
            return back()->with('success', 'Gruppo creato con successo!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Errore: ' . $e->getMessage());
        }
    }

    public function edit($groupId)
    {
        $customers = Customer::where('group_id', $groupId)->get();
        if ($customers->isEmpty()) {
            return back()->with('error', 'Gruppo non trovato');
        }

        $customer = $customers->first();
        $siblings = $customers;
        $rooms = $customers->pluck('room_number');

        return view('groups.edit', compact('customer', 'siblings', 'rooms'));
    }

    public function update(Request $request, $customer_id)
    {
        $leader = Customer::findOrFail($customer_id);
        if (!$leader->group_id) {
            return back()->with('error', 'Questa prenotazione non appartiene ad un gruppo');
        }

        $request->validate([
            'description' => 'required|string',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date|after:arrival_date',
            'pax' => 'nullable|integer|min:0',
            'notes' => 'nullable|string'
        ]);

        $groupId = $leader->group_id;
        $arrival = Carbon::parse($request->arrival_date);
        $departure = Carbon::parse($request->departure_date);

        $groupRooms = Customer::where('group_id', $groupId)->pluck('room_number');

        // Controllo disponibilità escludendo il gruppo corrente
        $occupied = Customer::whereIn('room_number', $groupRooms)
            ->where('group_id', '!=', $groupId)
            ->where(function ($q) use ($arrival, $departure) {
                $q->where('arrival_date', '<', $departure->format('Y-m-d'))
                    ->where('departure_date', '>', $arrival->format('Y-m-d'));
            })->exists();

        if ($occupied) {
            return back()->withInput()->withErrors(['arrival_date' => 'Le date scelte confliggono con altre prenotazioni per le camere del gruppo.']);
        }

        $allCustomersInGroup = Customer::where('group_id', $groupId)->get();
        $totalPax = $request->pax ?? 0;
        $numRooms = $allCustomersInGroup->count();
        $basePax = $numRooms > 0 ? intdiv($totalPax, $numRooms) : 0;
        $remainder = $numRooms > 0 ? $totalPax % $numRooms : 0;

        $index = 0;
        /** @var \App\Models\Customer $cust */
        foreach ($allCustomersInGroup as $cust) {
            $paxForThisRoom = $basePax + ($index < $remainder ? 1 : 0);
            $cust->update([
                'group_name' => $request->description,
                'first_name' => $request->description,
                'arrival_date' => $request->arrival_date,
                'departure_date' => $request->departure_date,
                'pax' => $paxForThisRoom,
                'notes' => $request->notes,
            ]);
            $index++;
        }

        try {
            $this->backupService->createBackup('autosave_backup.sql');
        } catch (\Exception $e) {
            // Log silent
        }

        return back()->with('success', 'Gruppo aggiornato con successo');
    }

    public function destroy($groupId)
    {
        Customer::where('group_id', $groupId)->delete();

        // Backup manuale poiché delete() massivo non triggera gli observer
        try {
            $this->backupService->createBackup('autosave_backup.sql');
        } catch (\Exception $e) {
            // Log silent
        }

        return redirect()->route('welcome')->with('success', 'Gruppo eliminato.');
    }
}
