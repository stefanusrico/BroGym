@extends('layouts.base_admin.base_dashboard')
@section('judul', 'Ubah Status Membership')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Ubah Status Membership</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Beranda</a>
          </li>
          <li class="breadcrumb-item active">Ubah Status Membership</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  @if(session('status'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
    {{ session('status') }}
  </div>
  @endif
  <form method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Informasi Membership</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="inputID">ID Membership</label>
              <input type="text" id="inputID" class="form-control" value="{{ $membership->id }}" readonly>
            </div>
            <div class="form-group">
              <label for="inputUserID">ID User</label>
              <input type="text" id="inputUserID" class="form-control" value="{{ $membership->id_user }}" readonly>
            </div>
            <div class="form-group">
              <label for="inputStatus">Status</label>
              <select id="inputStatus" name="status" class="form-control @error('status') is-invalid @enderror">
                <option value="aktif" {{ $membership->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $membership->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
              </select>
              @error('status')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Ubah Status" class="btn btn-success float-right">
      </div>
    </div>
  </form>
</section>
<!-- /.content -->

@endsection