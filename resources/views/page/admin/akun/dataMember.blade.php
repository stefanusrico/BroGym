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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Membership</title>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">

  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>

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

  <script>
  $(document).ready(function() {
    // Initialize DataTable
    var table = $('#table-membership').DataTable({
      ajax: {
        url: '/membership',
        dataSrc: 'data'
      },
      columns: [{
          data: 'id'
        },
        {
          data: 'id_user'
        },
        {
          data: 'status'
        },
        {
          data: 'tanggal_langganan'
        },
        {
          data: null,
          render: function(data) {
            return `
                            <a href="/membership/${data.id}/edit" class="btn btn-primary">Edit</a>
                            <a href="/membership/${data.id}" class="btn btn-danger">Hapus</a>
                        `;
          }
        }
      ]
    });
  });
  </script>

</body>

</html>