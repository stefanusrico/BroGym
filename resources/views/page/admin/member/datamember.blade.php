@extends('layouts.base_admin.base_dashboard')
@section('judul', 'List Akun')
@section('script_head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Tambahkan script Yajra DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Member</h1>
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

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"></h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0" style="margin: 20px">
      <table id="previewMember" class="table table-striped table-bordered display" style="width:100%">
        <thead>
          <tr>
            <th>ID_Member</th>
            <th>ID_User</th>
            <th>Status</th>
            <th>Tanggal Langganan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</section>
@endsection

@section('script_footer')
<!-- Ganti script DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
  $('#previewMember').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "{{ route('membership.getDataMember') }}",
      "dataType": "json",
      "type": "POST",
      "data": {
        _token: "{{ csrf_token() }}"
      }
    },
    "columns": [{
        "data": "id"
      },
      {
        "data": "id_user"
      },
      {
        "data": "status"
      },
      {
        "data": "tanggal_langganan"
      },
      {
        "data": "action"
      }
    ],
    "buttons": [
      'copy', 'excel', 'pdf'
    ],
    "language": {
      // Your language settings
    }
  });

  // hapusdata
  $('#previewMember').on('click', '.hapusData', function() {
    var id = $(this).data("id");
    var url = $(this).data("url");

    console.log("Clicked on element with id:", id);
    console.log("Clicked on element with url:", url);

    Swal.fire({
      title: 'Apa kamu yakin?',
      text: "Kamu tidak akan dapat mengembalikan ini!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: url,
          type: 'DELETE',
          data: {
            "id": id,
            "_token": "{{ csrf_token() }}"
          },
          success: function(response) {
            Swal.fire('Terhapus!', response.msg, 'success');
            $('#previewMember').DataTable().ajax.reload();
          },
          error: function(xhr, status, error) {
            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
          }
        });
      }
    });
  });
});
</script>
@endsection