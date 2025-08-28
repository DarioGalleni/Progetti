<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = [
            // Prenotazioni per oggi
            [
                'name' => 'Mario Rossi',
                'email' => 'mario.rossi@email.com',
                'phone' => '3331234567',
                'people' => 4,
                'date' => now()->format('Y-m-d'),
                'time_slot' => 'lunch',
                'time' => '12:30',
                'notes' => 'Tavolo vicino alla finestra se possibile',
                'tables_needed' => 1,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Anna Verdi',
                'email' => 'anna.verdi@email.com',
                'phone' => '3332345678',
                'people' => 2,
                'date' => now()->format('Y-m-d'),
                'time_slot' => 'lunch',
                'time' => '13:00',
                'notes' => 'Menu vegetariano',
                'tables_needed' => 1,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Luigi Bianchi',
                'email' => 'luigi.bianchi@email.com',
                'phone' => '3333456789',
                'people' => 6,
                'date' => now()->format('Y-m-d'),
                'time_slot' => 'dinner',
                'time' => '20:00',
                'notes' => 'Compleanno - torta già prenotata',
                'tables_needed' => 2,
                'modification_token' => Str::random(32)
            ],
            
            // Prenotazioni per domani
            [
                'name' => 'Giulia Neri',
                'email' => 'giulia.neri@email.com',
                'phone' => '3334567890',
                'people' => 3,
                'date' => now()->addDay()->format('Y-m-d'),
                'time_slot' => 'lunch',
                'time' => '12:15',
                'notes' => null,
                'tables_needed' => 1,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Marco Gialli',
                'email' => 'marco.gialli@email.com',
                'phone' => '3335678901',
                'people' => 8,
                'date' => now()->addDay()->format('Y-m-d'),
                'time_slot' => 'dinner',
                'time' => '19:30',
                'notes' => 'Cena di lavoro - fattura richiesta',
                'tables_needed' => 2,
                'modification_token' => Str::random(32)
            ],
            
            // Prenotazioni tra una settimana
            [
                'name' => 'Sofia Blu',
                'email' => 'sofia.blu@email.com',
                'phone' => '3336789012',
                'people' => 5,
                'date' => now()->addWeek()->format('Y-m-d'),
                'time_slot' => 'dinner',
                'time' => '21:00',
                'notes' => 'Anniversario di matrimonio',
                'tables_needed' => 2,
                'modification_token' => Str::random(32)
            ]
        ];

        foreach ($reservations as $reservation) {
            Reservation::create($reservation);
        }
    }
}
