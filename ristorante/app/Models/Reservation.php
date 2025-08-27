<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'date', 'time', 'people', 
        'tables_required', 'notes', 'confirmed'
    ];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    // Calcola quanti tavoli sono necessari per il numero di persone
    public static function calculateTablesRequired($people)
    {
        return ceil($people / 4);
    }
    
    // Genera un codice di prenotazione casuale
    // public static function generateReservationCode()
    // {
    //     $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $code = '';
        
    //     for ($i = 0; $i < 6; $i++) {
    //         $code .= $characters[random_int(0, strlen($characters) - 1)];
    //     }
        
    //     return $code;
    // }
}