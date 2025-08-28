<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email', 
        'phone',
        'people',
        'date',
        'time_slot',
        'time',
        'notes',
        'tables_needed',
        'status',
        'modification_token'
    ];
    
    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];
    
    // Calcola quanti tavoli servono in base al numero di persone
    public static function calculateTablesNeeded($people)
    {
        return ceil($people / 4);
    }
    
    // Verifica se l'orario è nel slot pranzo
    public function isLunchSlot()
    {
        return $this->time_slot === 'lunch';
    }
    
    // Verifica se l'orario è nel slot cena
    public function isDinnerSlot()
    {
        return $this->time_slot === 'dinner';
    }
    
    // Scope per ottenere prenotazioni di un giorno specifico
    public function scopeForDate($query, $date)
    {
        return $query->where('date', $date)->where('status', 'confirmed');
    }
    
    // Scope per ottenere prenotazioni per slot
    public function scopeForTimeSlot($query, $timeSlot)
    {
        return $query->where('time_slot', $timeSlot);
    }
}
