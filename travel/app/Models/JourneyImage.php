<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JourneyImage extends Model
{
    protected $fillable = ['journey_id', 'path'];

    public function journey()
    {
        return $this->belongsTo(Journey::class);
    }
}
