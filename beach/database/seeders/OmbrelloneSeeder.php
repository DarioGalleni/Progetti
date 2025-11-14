<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ombrellone;

class OmbrelloneSeeder extends Seeder
{
    public function run(): void
    {
        $file = ['A', 'B', 'C', 'D'];
        
        foreach ($file as $fila) {
            for ($i = 1; $i <= 30; $i++) {
                Ombrellone::create([
                    'numero' => $i,
                    'fila' => $fila
                ]);
            }
        }
    }
}