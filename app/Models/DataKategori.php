<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataKategori extends Model
{
    protected $fillable = [
        'kd_kategori',
        'nama_data',
        'tabel_referensi'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kd_kategori', 'kd_kategori');
    }
}

