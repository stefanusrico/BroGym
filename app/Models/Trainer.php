<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $table = 'trainer';
    protected $primaryKey = 'id_trainer';
    protected $fillable = [
        'id_jadwal',
        'nama_trainer',
        'gaji',
        'email',
        'password',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
}