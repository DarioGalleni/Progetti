<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['customer_id', 'description', 'amount'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
