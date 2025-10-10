<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'destination',
        'duration',
        'details',
        'price',
        'image_path'
    ];
}