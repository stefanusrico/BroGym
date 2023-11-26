<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['id_user', 'nama_transaksi', 'harga', 'tanggal'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }
}