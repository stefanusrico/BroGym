<!-- resources/views/laporan/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Laporan</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('laporan.update', $laporan->id_laporan) }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="jenis_laporan" class="form-label">Jenis Laporan</label>
                <input type="text" class="form-control" id="jenis_laporan" name="jenis_laporan" value="{{ $laporan->jenis_laporan }}" required>
            </div>
            <div class="mb-3">
                <label for="detail_laporan" class="form-label">Detail Laporan</label>
                <textarea class="form-control" id="detail_laporan" name="detail_laporan" required>{{ $laporan->detail_laporan }}</textarea>
            </div>
            <div class="mb-3">
                <label for="tanggal_laporan" class="form-label">Tanggal Laporan</label>
                <input type="date" class="form-control" id="tanggal_laporan" name="tanggal_laporan" value="{{ $laporan->tanggal_laporan }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
