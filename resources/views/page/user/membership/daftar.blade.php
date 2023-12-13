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
    <!--=======================================================================================-->
  @if($statusMember == 0)
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="membership_id" class="form-label">Status Membership</label>
            <select class="form-control" id="membership_id" name="membership_id" disabled>

              <option value="{{ $statusMember }}">{{ $statusMember == 1 ? 'Member' : 'NonMember' }}</option>
              <!-- Tambahkan opsi lain sesuai kebutuhan -->
            </select>
          </div>
        </div>

      </div>

    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <form action="{{ route('user.pembayaran') }}" method="post" enctype="multipart/form-data">
          @csrf
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
              <!-- Tambahkan input file untuk bukti pembayaran -->
              <div class="col-md-6">
                  <div class="mb-3">
                      <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                      <input type="file" name="bukti_pembayaran" class="form-control">
                  </div>
              </div>
              <!-- Tambahkan input hidden untuk menyimpan ID pengguna -->
              <input type="hidden" id="id_user" name="id_user" value="{{ $user_id }}">
          </div>
          <!-- Tambahkan input hidden untuk menyimpan membership_id -->
          <input type="hidden" id="membership_id_hidden" name="membership_id" value="1">
          <button type="submit" class="btn btn-success">Berlangganan</button>
      </form>
  </div>

</div>


  @else
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="membership_id" class="form-label">Status Membership</label>
            <select class="form-control" id="membership_id" name="membership_id" disabled>


              <option value="{{ $statusMember }}">{{ $statusMember == 1 ? 'Member' : 'NonMember' }}</option>
              <!-- Tambahkan opsi lain sesuai kebutuhan -->
            </select>
            Tanggal Langganan : {{$tanggalLangganan}} <br>
            Tanggal Berakhir  : {{$formattedTanggalKadaluarsa}}
          </div>
        </div>

      </div>

    </div>
  </div>
  @endif




  <!--=======================================================================================-->
  <!-- Tambahkan formulir berlangganan hanya jika status member adalah NonMember -->

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
