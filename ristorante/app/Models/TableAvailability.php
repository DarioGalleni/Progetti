<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableAvailability extends Model
{
    use HasFactory;
    
    protected $table = 'table_availability';
    protected $fillable = ['date', 'time_slot', 'available_tables'];
    
    // Verifica se ci sono tavoli sufficienti disponibili
    public static function hasAvailableTables($date, $time, $tablesNeeded)
    {
        $availability = self::where('date', $date)
            ->where('time_slot', $time)
            ->first();
            
        if (!$availability) {
            // Se non c'è record, significa che nessun tavolo è stato prenotato
            return true;
        }
        
        return $availability->available_tables >= $tablesNeeded;
    }
    
    // Aggiorna la disponibilità dei tavoli
    public static function updateAvailability($date, $time, $tablesNeeded)
    {
        $availability = self::firstOrNew([
            'date' => $date,
            'time_slot' => $time
        ]);
        
        if (!$availability->exists) {
            $availability->available_tables = 20; // Inizializza con il totale dei tavoli
        }
        
        $availability->available_tables -= $tablesNeeded;
        $availability->save();
        
        return $availability->available_tables;
    }
}