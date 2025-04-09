<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kemiskinan extends Model
{
    use HasFactory;

    protected $fillable = [
        'iddesa',
        'nama_program',
        'jumlah_penerima'
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'iddesa', 'iddesa');
    }
}



