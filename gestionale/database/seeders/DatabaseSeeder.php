<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $sql = file_get_contents(database_path('../customer.sql'));

        DB::unprepared($sql);

        $this->command->info('Database popolato con successo!');
    }
}

//  Ecco i comandi disponibili:
// 1. Se parti da ZERO (database vuoto):
// bash
// php artisan migrate --seed
// ✅ Questo crea le tabelle E popola il database in un solo comando

// 2. Se vuoi RESETTARE tutto e ripartire da zero:
// bash
// php artisan migrate:fresh --seed
// ✅ Questo cancella tutto, ricrea le tabelle E popola il database

// 3. Se le tabelle esistono già e vuoi solo aggiungere i dati:
// bash
// php artisan db:seed
// ✅ Questo popola solo il database (come abbiamo fatto prima) 