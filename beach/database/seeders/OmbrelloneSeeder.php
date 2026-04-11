<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ombrellone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class OmbrelloneSeeder extends Seeder
{
    public function run(): void
    {
        // Disabilita i vincoli delle chiavi esterne per permettere il truncate
        Schema::disableForeignKeyConstraints();
        DB::table('prenotazioni')->truncate();
        DB::table('ombrelloni')->truncate();
        Schema::enableForeignKeyConstraints();

        // Sida gli ombrelloni (4 file da 30 ombrelloni ciascuna)
        $file = ['A', 'B', 'C', 'D'];

        foreach ($file as $fila) {
            for ($i = 1; $i <= 30; $i++) {
                Ombrellone::create([
                    'numero' => $i,
                    'fila' => $fila
                ]);
            }
        }

        // Sida le prenotazioni leggendo il file database.sql
        $path = base_path('database.sql');
        if (File::exists($path)) {
            $sql = File::get($path);
            DB::unprepared($sql);
        }
    }
}