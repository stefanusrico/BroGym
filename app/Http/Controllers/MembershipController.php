<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Membership;

class MembershipController extends Controller
{
    public function store(Request $request)
    {
        $user = User::findOrFail($request->id_user);

        $pembayaran = Pembayaran::create([
            'id_user' => $user->id,
            'harga' => $request->harga,
            'tanggal' => $request->tanggal,
        ]);

        $membership = Membership::create([
            'id_user' => $user->id,
            'status' => 'aktif',
            'tanggal_langganan' => $pembayaran->tanggal,
        ]);

        return response()->json([
            'message' => 'Membership berhasil dibuat',
            'membership' => $membership,
        ]);
    }
}