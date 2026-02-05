<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'room_number',
        'arrival_date',
        'departure_date',
        'treatment',
        'pax',
        'under_12_pax',
        'total_price',
        'deposit',
        'payment_method',
        'notes',
        'group_id',
        'group_name',
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
