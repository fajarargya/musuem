<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Gunakan kelas ini untuk autentikasi
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    public function favoriteMuseums()
    {
        return $this->belongsToMany(Museum::class, 'favorite_museum', 'user_id', 'museum_id');
    }
}