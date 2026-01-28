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
        // Pulisce la tabella prima di inserire nuovi dati (opzionale, ma richiesto implicitamente da "elimina contenuto già presente" inteso come sostituisci il seeder, ma se l'utente vuole svuotare il DB dovrebbe usare migrate:fresh --seed)
        // Tuttavia, il seeder crea nuovi record. Se si vuole evitare duplicati in fase di sviluppo locale senza reset, si può usare truncate() se non ci sono vincoli di foreign key bloccanti o se si disabilitano.
        // Journey::truncate(); // Commentato per sicurezza, sovrascriverò solo l'array.

        $journeys = [
            [
                'title' => 'Sud Africa: Safari & Città del Capo',
                'description' => 'Un viaggio incredibile tra la natura selvaggia del Kruger National Park e la cosmopolita Città del Capo. Ammira i Big Five, esplora la Garden Route e degusta i migliori vini nelle Winelands.',
                'price' => 3200.00,
                'duration_days' => 12,
                'image' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=2068&q=80', // Lion/Safari
                'includes' => ['Voli Internazionali', 'Safari Guidati', 'Alloggi Lusso', 'Degustazione Vini'],
                'excludes' => ['Mance', 'Spese Personali', 'Assicurazione Extra'],
                'itinerary' => [
                    [
                        'title' => 'Arrivo a Cape Town',
                        'description' => 'Atterraggio e trasferimento in hotel con vista sulla Table Mountain.'
                    ],
                    [
                        'title' => 'Capo di Buona Speranza',
                        'description' => 'Escursione alla penisola del Capo e visita alla colonia di pinguini di Boulders Beach.'
                    ],
                    [
                        'title' => 'Winelands',
                        'description' => 'Giornata dedicata alla degustazione di vini nelle prestigiose tenute di Stellenbosch.'
                    ],
                    [
                        'title' => 'Volo per il Kruger',
                        'description' => 'Trasferimento aereo verso il parco nazionale per l\'inizio dell\'avventura safari.'
                    ],
                    [
                        'title' => 'Safari Fotografico',
                        'description' => 'Intera giornata di Game Drive alla ricerca dei Big Five.'
                    ]
                ]
            ],
            [
                'title' => 'Namibia: Dune, Deserto e Oceano',
                'description' => 'Un\'avventura on the road attraverso i paesaggi surreali della Namibia. Dalle dune rosse di Sossusvlei alla costa spettrale di Skeleton Coast, fino alla fauna dell\'Etosha.',
                'price' => 2900.00,
                'duration_days' => 14,
                'image' => 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1972&q=80', // Desert/Dunes
                'includes' => ['Noleggio 4x4', 'Pernottamenti in Lodge', 'Ingressi Parchi', 'Cena nel Deserto'],
                'excludes' => ['Carburante', 'Voli Internazionali', 'Pasti non indicati'],
                'itinerary' => [
                    [
                        'title' => 'Windhoek',
                        'description' => 'Ritiro del fuoristrada e briefing sul viaggio.'
                    ],
                    [
                        'title' => 'Deserto del Namib',
                        'description' => 'Arrivo a Sossusvlei e tramonto sulla Duna 45.'
                    ],
                    [
                        'title' => 'Deadvlei',
                        'description' => 'Alba nella valle degli alberi morti, un paesaggio lunare unico al mondo.'
                    ],
                    [
                        'title' => 'Swakopmund',
                        'description' => 'Trasferimento sulla costa e attività adrenaliniche sulle dune.'
                    ]
                ]
            ],
            [
                'title' => 'Patagonia: Terra alla Fine del Mondo',
                'description' => 'Esplora i ghiacciai perenni, le vette andine e la natura incontaminata tra Cile e Argentina. Trekking sul Perito Moreno e Torres del Paine.',
                'price' => 3500.00,
                'duration_days' => 15,
                'image' => 'https://images.unsplash.com/photo-1483728642387-6c3bdd6c93e5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', // Mountains/Patagonia
                'includes' => ['Voli Interni', 'Guide Alpine', 'Trekking Pass', 'Crociera sui Ghiacciai'],
                'excludes' => ['Attrezzatura Tecnica', 'Pranzi al sacco extra'],
                'itinerary' => [
                    [
                        'title' => 'Buenos Aires',
                        'description' => 'Arrivo nella capitale argentina e serata di Tango.'
                    ],
                    [
                        'title' => 'El Calafate',
                        'description' => 'Volo verso il sud e prima vista del Lago Argentino.'
                    ],
                    [
                        'title' => 'Perito Moreno',
                        'description' => 'Trekking emozionante sulla superficie del ghiacciaio più famoso del mondo.'
                    ],
                    [
                        'title' => 'Torres del Paine',
                        'description' => 'Attraversamento del confine cileno ed escursione alle tre torri di granito.'
                    ]
                ]
            ],
            [
                'title' => 'Alsazia: Borghi da Favola e Mercatini',
                'description' => 'Un tour incantato tra i villaggi medievali, i canali di Colmar e la strada dei vini ai piedi dei Vosgi. Magico in ogni stagione, indimenticabile a Natale.',
                'price' => 1100.00,
                'duration_days' => 5,
                'image' => 'https://www.earthtrekkers.com/wp-content/uploads/2025/01/Colmar-at-Christmas.jpg.optimal.jpg', // Colmar/Alsace style
                'includes' => ['Hotel di Charme', 'Degustazioni Vini', 'Visita Strasburgo', 'Trasporti Locali'],
                'excludes' => ['Volo A/R', 'Tassa di Soggiorno', 'Cene libere'],
                'itinerary' => [
                    [
                        'title' => 'Strasburgo',
                        'description' => 'Visita alla cattedrale e giro in battello sulla Petite France.'
                    ],
                    [
                        'title' => 'Strada dei Vini',
                        'description' => 'Percorso panoramico tra vigneti e castelli con stop a Riquewihr.'
                    ],
                    [
                        'title' => 'Colmar',
                        'description' => 'Passeggiata nella "Piccola Venezia" e visita al museo Unterlinden.'
                    ]
                ]
            ],
            [
                'title' => 'Islanda: Tra Ghiaccio e Fuoco',
                'description' => 'Un viaggio on the road lungo la Ring Road per scoprire cascate potenti, geyser, vulcani attivi e lagune termali. La natura nella sua forma più pura.',
                'price' => 2400.00,
                'duration_days' => 9,
                'image' => 'https://images.unsplash.com/photo-1476610182048-b716b8518aae?ixlib=rb-4.0.3&auto=format&fit=crop&w=2159&q=80', // Iceland Landscape
                'includes' => ['Noleggio Auto', 'Pernottamenti', 'Blue Lagoon', 'Escursione Ghiacciaio'],
                'excludes' => ['Carburante', 'Pasti', 'Voli'],
                'itinerary' => [
                    [
                        'title' => 'Reykjavik',
                        'description' => 'Arrivo nella capitale più a nord del mondo e relax.'
                    ],
                    [
                        'title' => 'Circolo d\'Oro',
                        'description' => 'Visita a Thingvellir, Geysir e la cascata Gullfoss.'
                    ],
                    [
                        'title' => 'Costa Sud',
                        'description' => 'Le cascate di Seljalandsfoss e Skogafoss, e la spiaggia nera di Reynisfjara.'
                    ],
                    [
                        'title' => 'Jokulsarlon',
                        'description' => 'Navigazione tra gli iceberg della laguna glaciale.'
                    ]
                ]
            ],
        ];

        foreach ($journeys as $journey) {
            Journey::create($journey);
        }
    }
}