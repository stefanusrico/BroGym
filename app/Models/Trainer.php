<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $table = 'trainer';
    protected $primaryKey = 'id_trainer';
    protected $fillable = [
        'nama_trainer',
        'gaji',
        'email',
        'password',
    ];
}