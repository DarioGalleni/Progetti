<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $genres = ['Maschio', 'Femmina'];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'genre' => $genre
            ]);
        }
    }
}
