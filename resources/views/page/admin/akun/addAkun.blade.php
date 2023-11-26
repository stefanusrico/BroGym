@extends('layouts.base_admin.base_dashboard') @section('judul', 'Tambah Akun')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Akun</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Beranda</a>
          </li>
          <li class="breadcrumb-item active">Tambah Akun</li>
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
            <h3 class="card-title">Informasi Data Diri</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Nama</label>
              <input type="text" id="inputName" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Masukkan Nama" value="{{ old('name') }}" required="required" autocomplete="name">
              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="inputEmail">Email</label>
              <input type="email" id="inputEmail" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Masukkan Email" value="{{ old('email') }}" required="required" autocomplete="email">
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="input-group mb-3">
              <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                <option value="" disabled selected>Pilih Role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
              </select>
              @error('role')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="input-group mb-3">
              <input id="age" type="number" placeholder="Umur" class="form-control @error('age') is-invalid @enderror"
                name="age" value="{{ old('age') }}" required="required" autocomplete="age">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-calendar"></span>
                </div>
              </div>
              @error('age')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="input-group mb-3">
              <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="male">Laki-Laki</option>
                <option value="female">Perempuan</option>
              </select>
              @error('gender')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="input-group mb-3">
              <input id="phone_number" type="text" placeholder="Nomor Telepon"
                class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                value="{{ old('phone_number') }}" required="required" autocomplete="phone_number">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-phone"></span>
                </div>
              </div>
              @error('phone_number')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="inputFoto">Foto Profil</label>
              <div class="row">
                <div class="col-md-4">
                  <img class="elevation-3" id="prevImg" src="{{ asset('vendor/adminlte3/img/user2-160x160.jpg') }}"
                    width="150px" />
                </div>
                <div class="col-md-8">
                  <input type="file" id="inputFoto" name="user_image" accept="image/*"
                    class="form-control @error('user_image') is-invalid @enderror" placeholder="Upload foto profil">
                </div>
              </div>

              @error('user_image')
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
      <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Password</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="password">Password</label>
              <input id="password" type="password" placeholder="Kata Sandi"
                class="form-control @error('password') is-invalid @enderror" name="password" required="required"
                autocomplete="new-password">
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="password-confirm">Konfirmasi Password</label>
              <input placeholder="Ketik ulang kata sandi" id="password-confirm" type="password" class="form-control"
                name="password_confirmation" required="required" autocomplete="new-password">
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Tambah Akun" class="btn btn-success float-right">
      </div>
    </div>
  </form>
</section>
<!-- /.content -->

@endsection @section('script_footer')
<script>
inputFoto.onchange = evt => {
  const [file] = inputFoto.files
  if (file) {
    prevImg.src = URL.createObjectURL(file)
  }
}
</script>
@endsection