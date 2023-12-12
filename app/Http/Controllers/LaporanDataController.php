<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanDataController extends Controller
{
    public function index()
    {
        // Menggunakan model Laporan dan memilih kolom tertentu
        $laporanData = Laporan::select(['id_laporan', 'jenis_laporan', 'detail_laporan', 'tanggal_laporan'])
            ->get();

        return datatables()->of($laporanData)->toJson();
    }

    // Tambahkan fungsi lain sesuai kebutuhan, seperti store, update, show, dan destroy.
}
