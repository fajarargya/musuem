<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tabel di database tidak sesuai dengan nama model (optional)
    protected $table = 'activities';

    // Kolom yang diizinkan untuk diisi (mass assignment)
    protected $fillable = [
        'title', 'museum', 'image', 'date', 'time', 'location', 'ticket_price', 'contact', 'registration_link',
    ];

    // Kalau model memiliki relasi dengan model lain, bisa ditambahkan di sini
}
