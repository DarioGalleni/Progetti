<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Prenotazione extends Model
{
    use HasFactory;

    protected $table = 'prenotazioni'; 

    protected $fillable = [
        'ombrellone_id',
        'note',
        'nome',
        'cognome',
        'telefono',
        'email',
        'data_inizio',
        'data_fine',
        'note',
        'costo_totale', 
        'acconto'
    ];
    
    protected $casts = [
        'data_inizio' => 'date',
        'data_fine' => 'date',
    ];

    // Relazione con l'Ombrellone
    public function ombrellone(): BelongsTo
    {
        return $this->belongsTo(Ombrellone::class);
    }
    
    /**
     * Attributo virtuale per la data di Partenza (effettiva, giorno in cui l'ombrellone è libero).
     * Partenza è la data_fine stored (+ 1 giorno).
     */
    public function getPartenzaAttribute(): ?string
    {
        if ($this->data_fine) {
            return $this->data_fine->copy()->addDay()->toDateString(); 
        }
        return null;
    }

    /**
     * Attributo virtuale per la data di Arrivo (alias di data_inizio).
     */
    public function getArrivoAttribute(): ?string
    {
        return $this->data_inizio ? $this->data_inizio->toDateString() : null; 
    }
}