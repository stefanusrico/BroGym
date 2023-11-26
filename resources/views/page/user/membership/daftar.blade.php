@extends('layouts.base_user.base_dashboard')
@section('judul', 'Daftar Membership')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Daftar Membership</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Beranda</a>
          </li>
          <li class="breadcrumb-item active">Daftar Membership</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <!-- Tambahkan formulir berlangganan di sini -->
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="membership_id" class="form-label">Pilih Keanggotaan</label>
            <select class="form-control" id="membership_id" name="membership_id">
              <option value="1" data-harga="100000">Membership 1 - Rp 100.000</option>
              <!-- Tambahkan opsi lain sesuai kebutuhan -->
            </select>
          </div>
        </div>
        <input type="hidden" id="harga" name="harga" value="">
      </div>
      <form action="{{ route('user.pembayaran') }}" method="post">
        @csrf
        <input type="hidden" name="membership_id" value="1"> <!-- Nilai default, sesuaikan dengan kebutuhan -->
        <button type="submit" class="btn btn-success">Berlangganan</button>
      </form>
    </div>
  </div>
</section>
<!-- /.content -->
@endsection

@section('script_footer')
<!-- Tambahkan script DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
  // Inisialisasi DataTables
  // $('#membershipTable').DataTable(); // Jika Anda tidak menggunakan tabel, komentar atau hapus baris ini
});
</script>
@endsection