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
        'room',
        'arrival_date',
        'departure_date',
        'treatment',
        'phone',
        'email',
        'number_of_people',
        'total_stay_cost',
        'down_payment',
        'additional_notes',
        'is_booking',
        'is_cash_payment',
        'is_group',
    ];

    protected $casts = [
        'is_group' => 'boolean',
        'is_booking' => 'boolean',
        'is_cash_payment' => 'boolean',
    ];

    /**
     * Get the expenses for the customer.
     */
    public function expenses()
    {
        return $this->hasMany(CustomerExpense::class);
    }
}
