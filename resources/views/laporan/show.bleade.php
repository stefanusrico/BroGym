<!-- resources/views/laporan/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Laporan</h1>

        <div class="mb-3">
            <strong>Jenis Laporan:</strong> {{ $laporan->jenis_laporan }}
        </div>
        <div class="mb-3">
            <strong>Detail Laporan:</strong> {{ $laporan->detail_laporan }}
        </div>
        <div class="mb-3">
            <strong>Tanggal Laporan:</strong> {{ $laporan->tanggal_laporan }}
        </div>

        <a href="{{ route('laporan.index') }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection
