<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Ombrellone extends Model
{
    protected $table = 'ombrelloni';
    
    protected $fillable = ['numero', 'fila'];

    public function prenotazioni(): HasMany
    {
        return $this->hasMany(Prenotazione::class); 
    }

    /**
     * Verifica se l'ombrellone è prenotato per una data specifica.
     */
    public function isPrenotatoPerData($date)
    {
        $dateCarbon = $date instanceof Carbon ? $date : Carbon::parse($date);
        
        if ($this->relationLoaded('prenotazioni')) {
            return $this->prenotazioni->contains(function($prenotazione) use ($dateCarbon) {
                // Confronta gli oggetti Carbon
                return $prenotazione->data_inizio->lte($dateCarbon) && $prenotazione->data_fine->gte($dateCarbon);
            });
        }
        
        return $this->prenotazioni()
            ->where('data_inizio', '<=', $date)
            ->where('data_fine', '>=', $date)
            ->exists();
    }
    
    /**
     * Restituisce l'oggetto Prenotazione per una data specifica.
     */
    public function getPrenotazionePerData($date)
    {
        $dateCarbon = $date instanceof Carbon ? $date : Carbon::parse($date);
        
        if ($this->relationLoaded('prenotazioni')) {
            return $this->prenotazioni->first(function($prenotazione) use ($dateCarbon) {
                // Confronta gli oggetti Carbon
                return $prenotazione->data_inizio->lte($dateCarbon) && $prenotazione->data_fine->gte($dateCarbon);
            });
        }
        
        return $this->prenotazioni()
            ->where('data_inizio', '<=', $date)
            ->where('data_fine', '>=', $date)
            ->first();
    }

    /**
     * Verifica se l'ombrellone è prenotato per un periodo.
     */
    public function isPrenotatoPerPeriodo($dataInizio, $dataFine)
    {
        return $this->prenotazioni()
            ->where(function($query) use ($dataInizio, $dataFine) {
                $query->whereBetween('data_inizio', [$dataInizio, $dataFine])
                      ->orWhereBetween('data_fine', [$dataInizio, $dataFine])
                      ->orWhere(function($q) use ($dataInizio, $dataFine) {
                          $q->where('data_inizio', '<=', $dataInizio)
                            ->where('data_fine', '>=', $dataFine);
                      });
            })
            ->exists();
    }

    public function getIdentificativoAttribute()
    {
        return 'Fila ' . $this->fila . ' - Ombrellone ' . $this->numero;
    }
}