<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Museum extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'provinsi',
        'kota',
        'jumlah_koleksi',
        'jenis_pemilik',
        'pemilik',
        'tipe_akhir',
        'nomor_pendaftaran',
        'gambar',
        'latitude',      
        'longitude',
    ];
    public function favoredByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite_museum')->withTimestamps();
    }

}
