<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'jabatan', 'foto', 'iddesa'];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'iddesa');
    }
}
