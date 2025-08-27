<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function welcome()
    {           $testimonials = [
    [
        'stars' => 5,
        'text' => 'La migliore carbonara che abbia mai mangiato! Atmosfera accogliente e servizio impeccabile.',
        'authorImg' => 'https://randomuser.me/api/portraits/women/32.jpg',
        'authorName' => 'Maria Bianchi',
        'source' => 'Google Recensioni'
    ],
    [
        'stars' => 5,
        'text' => 'Il branzino al cartoccio era perfetto. Tornerò sicuramente per provare altri piatti del menu.',
        'authorImg' => 'https://randomuser.me/api/portraits/men/75.jpg',
        'authorName' => 'Luigi Verdi',
        'source' => 'TripAdvisor'
    ],
    [
        'stars' => 4.5,
        'text' => 'Ottima selezione di vini abbinata a piatti deliziosi. Consiglio vivamente l\'antipasto misto.',
        'authorImg' => 'https://randomuser.me/api/portraits/women/63.jpg',
        'authorName' => 'Anna Rossi',
        'source' => 'Facebook'
    ],
    [
        'stars' => 5,
        'text' => 'Servizio veloce e personale gentilissimo. Il filetto di manzo era eccezionale!',
        'authorImg' => 'https://randomuser.me/api/portraits/men/34.jpg',
        'authorName' => 'Marco Neri',
        'source' => 'Google Recensioni'
    ],
    [
        'stars' => 4,
        'text' => 'Locale molto pulito e curato. Ottimi i primi piatti, soprattutto la lasagna.',
        'authorImg' => 'https://randomuser.me/api/portraits/women/45.jpg',
        'authorName' => 'Giulia Fontana',
        'source' => 'Facebook'
    ],
    [
        'stars' => 5,
        'text' => 'Esperienza fantastica! Il personale ci ha fatto sentire come a casa.',
        'authorImg' => 'https://randomuser.me/api/portraits/men/22.jpg',
        'authorName' => 'Alessandro Moretti',
        'source' => 'TripAdvisor'
    ],
    [
        'stars' => 4.5,
        'text' => 'Ottimo rapporto qualità-prezzo. Consiglio il risotto ai funghi porcini!',
        'authorImg' => 'https://randomuser.me/api/portraits/women/12.jpg',
        'authorName' => 'Francesca Gallo',
        'source' => 'Google Recensioni'
    ],
    [
        'stars' => 5,
        'text' => 'Tutto perfetto, dal vino ai dolci. Torneremo sicuramente!',
        'authorImg' => 'https://randomuser.me/api/portraits/men/41.jpg',
        'authorName' => 'Davide Rinaldi',
        'source' => 'Facebook'
    ]
];
        
        return view('welcome', compact('testimonials'));

    }
}