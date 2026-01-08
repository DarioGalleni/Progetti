<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Journey;

class JourneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $journeys = [
            [
                'title'         => 'Giappone: Terra del Sol Levante',
                'description'   => 'Un viaggio indimenticabile tra tradizione e modernità. Visita Tokyo, Kyoto e Osaka, assisti alla fioritura dei ciliegi e immergiti nella cultura millenaria giapponese.',
                'price'         => 2500.00,
                'duration_days' => 10,
                'image'         => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
            ],
            [
                'title'         => 'Maldive: Il Paradiso in Terra',
                'description'   => 'Spiagge bianche, acqua cristallina e relax totale. Soggiorna in resort di lusso e goditi il mare incontaminato delle Maldive.',
                'price'         => 1800.00,
                'duration_days' => 7,
                'image'         => 'https://www.amerigo.it/application/files/5815/9523/5410/maldive_luoghi_di_interesse.jpg',
            ],
            [
                'title'         => 'Islanda: Luce del Nord',
                'description'   => 'A caccia dell\'aurora boreale tra ghiacciai, vulcani e cascate mozzafiato. Un\'avventura naturalistica senza eguali.',
                'price'         => 1200.00,
                'duration_days' => 5,
                'image'         => 'https://images.unsplash.com/photo-1476610182048-b716b8518aae?ixlib=rb-4.0.3&auto=format&fit=crop&w=2159&q=80',
            ],
            [
                'title'         => 'New York: La Città che non dorme',
                'description'   => 'Vivi l\'energia di Manhattan, passeggia a Central Park e sali sull\'Empire State Building. Il sogno americano ti aspetta.',
                'price'         => 1500.00,
                'duration_days' => 6,
                'image'         => 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
            ],
            [
                'title'         => 'Safari in Kenya',
                'description'   => 'Esplora la savana africana e ammira i "Big Five" nel loro habitat naturale. Un\'esperienza selvaggia e autentica.',
                'price'         => 2200.00,
                'duration_days' => 8,
                'image'         => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=2068&q=80',
            ],
            [
                'title'         => 'Perù: Sulle tracce degli Inca',
                'description'   => 'Un trekking emozionante verso Machu Picchu, attraverso la Valle Sacra e le meraviglie delle Ande peruviane.',
                'price'         => 2800.00,
                'duration_days' => 12,
                'image'         => 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?ixlib=rb-4.0.3&auto=format&fit=crop&w=2076&q=80',
            ],
        ];

        foreach ($journeys as $journey) {
            Journey::create($journey);
        }
    }
}