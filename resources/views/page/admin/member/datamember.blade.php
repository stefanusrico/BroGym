@extends('layouts.base_admin.base_dashboard')
@section('judul', 'List Membership')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Akun</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Beranda</a>
          </li>
          <li class="breadcrumb-item active">Akun</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<div class="container">
  <h1>Data Membership</h1>

  <table id="table-membership" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>ID User</th>
        <th>Status</th>
        <th>Tanggal Langganan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
  var table = $('#table-membership').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('membership.datamember') }}",
    columns: [{
        data: 'id_member',
        name: 'id_member'
      },
      {
        data: 'id_user',
        name: 'id_user'
      },
      {
        data: 'status',
        name: 'status'
      },
      {
        data: 'tanggal_langganan',
        name: 'tanggal_langganan'
      },
      {
        data: 'action',
        name: 'action',
        orderable: false,
        searchable: false
      },
    ]
  });
});
</script>
@endpush