<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irigasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'iddesa',
        'nama_irigasi',
        'panjang',
        'lebar',
        'kondisi',
        'lokasi'
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'iddesa', 'iddesa');
    }
}