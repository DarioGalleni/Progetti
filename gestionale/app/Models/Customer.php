<?php

// app/Models/Customer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
        'additional_expenses',

    ];

    public function expenses()
    {
        return $this->hasMany(CustomerExpense::class);
    }
}
