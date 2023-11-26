<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Trainer;


class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = [
        'id_user',
        'id_trainer',
        'sesi',
        'waktu_mulai',
        'waktu_berakhir',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'id_trainer');
    }
}