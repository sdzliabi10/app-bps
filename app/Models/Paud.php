<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paud extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sekolah',
        'nama_desa',
        'status',
        'jumlah_murid',
        'latitude',
        'longitude',
        'gambar_url',
    ];
}
