<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'item_image',
        'user_id',
        'price',

    ];

    /**
     * L'utente proprietario dell'articolo.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * I "Mi piace" associati a questo articolo.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Verifica se l'utente autenticato ha messo "Mi piace" a questo articolo.
     */
    public function likedByUser()
    {
        $userId = Auth::id();
        if (!$userId) {
            return false;
        }

        return $this->likes()->where('user_id', $userId)->exists();
    }
}
