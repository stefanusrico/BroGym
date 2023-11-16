<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function store(Request $request)
    {
        $pembayaran = Pembayaran::create([
            'id_user' => $request->id_user,
            'harga' => $request->harga,
            'tanggal' => $request->tanggal,
        ]);

        return response()->json([
            'message' => 'Pembayaran berhasil dilakukan',
            'pembayaran' => $pembayaran,
        ]);
    }
}