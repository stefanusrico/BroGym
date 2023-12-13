<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = [
        'id_user',
        'bukti',
        'harga',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
