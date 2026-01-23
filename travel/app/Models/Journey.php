<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'duration_days',
        'image',
        'includes',
        'excludes',
        'itinerary'
    ];

    protected $casts = [
        'includes' => 'array',
        'excludes' => 'array',
        'itinerary' => 'array',
    ];

    public function images()
    {
        return $this->hasMany(JourneyImage::class);
    }
}
