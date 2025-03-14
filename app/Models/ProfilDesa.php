<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    use HasFactory;

    protected $table = 'profil_desas';

    protected $fillable = [
        'kecamatan',
        'desa',
        'tahun',    
        'visi_misi',
        'program_unggulan',
        'batas_wilayah',
        'alamat',
        'telepon',
    ];
}
