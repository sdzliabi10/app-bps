<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $primaryKey = 'kd_kategori';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'kd_kategori',
        'nama_kategori'
    ];

    public function dataKategoris()
    {
        return $this->hasMany(DataKategori::class, 'kd_kategori', 'kd_kategori');
    }
}

