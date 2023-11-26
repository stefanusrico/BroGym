<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Membership extends Model
{
    use HasFactory;

    protected $table = 'membership';
    protected $primaryKey = 'id_member';
    protected $fillable = ['id_user', 'status', 'tanggal_langganan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}