<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::all();
        return view('laporan.index', compact('laporan'));
    }

    public function create()
    {
        return view('page.admin.laporan.create');
    }

    public function store(Request $request)
    {
        // Validasi data laporan
        $request->validate([
            'jenis_laporan' => 'required',
            'detail_laporan' => 'required',
            'tanggal_laporan' => 'required',
            // Sesuaikan dengan kolom-kolom pada model Laporan
        ]);

        // Simpan data laporan ke dalam database
        Laporan::create($request->all());

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditambahkan');
    }

    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        return view('laporan.edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        // Validasi data laporan
        $request->validate([
            'jenis_laporan' => 'required',
            'detail_laporan' => 'required',
            'tanggal_laporan' => 'required',
            // Sesuaikan dengan kolom-kolom pada model Laporan
        ]);

        // Perbarui data laporan ke dalam database
        $laporan->update($request->all());

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy(Laporan $laporan)
    {
        // Hapus data laporan dari database
        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus');
    }
}
