<!-- resources/views/laporan/index.blade.php -->
<!-- resources/views/layouts/base_admin/base_dashboard.blade.php -->



@extends('layouts.base_admin.base_dashboard')

<head>
    <!-- ... -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ... -->
</head>

@section('content')
    <h1>Data Laporan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-primary" id="laporan-table"> 
        <thead>
            <tr>
                <th>ID Laporan</th>
                <th>Id User</th>
                <th>Id Transaksi</th>
                <th>Harga Total</th>
                <th>Tanggal Laporan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
                <tr>
                    <td>{{ $item->id_laporan }}</td>
                    <td>{{ $item->id_user }}</td>
                    <td>{{ $item->id_transaksi }}</td>
                    <td>{{ $item->harga_total }}</td>
                    <td>{{ $item->tanggal_laporan }}</td>
                    <td>
                        <a href="{{ route('laporan.show', $item->id_laporan) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('laporan.edit', $item->id_laporan) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('laporan.destroy', $item->id_laporan) }}" method="post" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            $('#laporan-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("laporandataindex") }}', // router
                columns: [
                    { data: 'id_laporan', name: 'id_laporan' },
                    { data: 'id_user', name: 'id_user' },
                    { data: 'id_transaksi', name: 'id_transaksi' },
                    { data: 'harga_total', name: 'harga_total' },
                    { data: 'tanggal_laporan', name: 'tanggal_laporan' },
                ]
            });
        });
    </script>
@endpush

