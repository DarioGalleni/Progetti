<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerExpense extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'expense_type',
        'amount',
    ];

    /**
     * Get the customer that owns the expense.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}