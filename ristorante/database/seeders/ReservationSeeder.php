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
            ],

            // --- Nuovi record ---
            [
                'name' => 'Paolo Grigi',
                'email' => 'paolo.grigi@email.com',
                'phone' => '3337890123',
                'people' => 2,
                'date' => now()->addDays(2)->format('Y-m-d'),
                'time_slot' => 'lunch',
                'time' => '12:45',
                'notes' => 'Intolleranza al glutine',
                'tables_needed' => 1,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Elena Rosa',
                'email' => 'elena.rosa@email.com',
                'phone' => '3338901234',
                'people' => 7,
                'date' => now()->addDays(2)->format('Y-m-d'),
                'time_slot' => 'dinner',
                'time' => '20:15',
                'notes' => null,
                'tables_needed' => 2,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Francesco Viola',
                'email' => 'francesco.viola@email.com',
                'phone' => '3339012345',
                'people' => 4,
                'date' => now()->addDays(3)->format('Y-m-d'),
                'time_slot' => 'dinner',
                'time' => '19:45',
                'notes' => 'Richiesta sedia per bambino',
                'tables_needed' => 1,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Chiara Marrone',
                'email' => 'chiara.marrone@email.com',
                'phone' => '3330123456',
                'people' => 6,
                'date' => now()->addDays(3)->format('Y-m-d'),
                'time_slot' => 'lunch',
                'time' => '13:15',
                'notes' => null,
                'tables_needed' => 2,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Davide Nero',
                'email' => 'davide.nero@email.com',
                'phone' => '3331111111',
                'people' => 5,
                'date' => now()->addDays(4)->format('Y-m-d'),
                'time_slot' => 'dinner',
                'time' => '20:30',
                'notes' => 'Tavolo in terrazza',
                'tables_needed' => 2,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Laura Argento',
                'email' => 'laura.argento@email.com',
                'phone' => '3332222222',
                'people' => 3,
                'date' => now()->addDays(4)->format('Y-m-d'),
                'time_slot' => 'lunch',
                'time' => '12:00',
                'notes' => 'Menu vegano',
                'tables_needed' => 1,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Matteo Oro',
                'email' => 'matteo.oro@email.com',
                'phone' => '3333333333',
                'people' => 9,
                'date' => now()->addDays(5)->format('Y-m-d'),
                'time_slot' => 'dinner',
                'time' => '21:30',
                'notes' => 'Festa laurea',
                'tables_needed' => 3,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Alessia Verde',
                'email' => 'alessia.verde@email.com',
                'phone' => '3334444444',
                'people' => 2,
                'date' => now()->addDays(5)->format('Y-m-d'),
                'time_slot' => 'lunch',
                'time' => '13:30',
                'notes' => 'Allergia alle noci',
                'tables_needed' => 1,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Riccardo Azzurri',
                'email' => 'riccardo.azzurri@email.com',
                'phone' => '3335555555',
                'people' => 10,
                'date' => now()->addDays(6)->format('Y-m-d'),
                'time_slot' => 'dinner',
                'time' => '20:45',
                'notes' => 'Serata aziendale',
                'tables_needed' => 3,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Martina Viola',
                'email' => 'martina.viola@email.com',
                'phone' => '3336666666',
                'people' => 4,
                'date' => now()->addDays(6)->format('Y-m-d'),
                'time_slot' => 'lunch',
                'time' => '12:30',
                'notes' => null,
                'tables_needed' => 1,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Stefano Celeste',
                'email' => 'stefano.celeste@email.com',
                'phone' => '3337777777',
                'people' => 3,
                'date' => now()->addWeeks(2)->format('Y-m-d'),
                'time_slot' => 'dinner',
                'time' => '19:15',
                'notes' => 'Prenotazione anticipata',
                'tables_needed' => 1,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Federica Marrone',
                'email' => 'federica.marrone@email.com',
                'phone' => '3338888888',
                'people' => 5,
                'date' => now()->addWeeks(2)->format('Y-m-d'),
                'time_slot' => 'lunch',
                'time' => '13:00',
                'notes' => 'Evento speciale',
                'tables_needed' => 2,
                'modification_token' => Str::random(32)
            ],
            [
                'name' => 'Giovanni Corallo',
                'email' => 'giovanni.corallo@email.com',
                'phone' => '3339999999',
                'people' => 6,
                'date' => now()->addWeeks(2)->format('Y-m-d'),
                'time_slot' => 'dinner',
                'time' => '20:00',
                'notes' => 'Richiesta torta personalizzata',
                'tables_needed' => 2,
                'modification_token' => Str::random(32)
            ]
        ];

        foreach ($reservations as $reservation) {
            Reservation::create($reservation);
        }
    }
}
