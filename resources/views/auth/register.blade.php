@extends('layouts.base_admin.base_auth')

@section('judul', 'Halaman Registrasi')

@section('content')
<div class="register-box">
  <div class="register-logo">
    <a href="#">
      <b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Registrasi Akun Baru</p>

      <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input id="name" type="text" placeholder="Nama Lengkap"
            class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
            required="required" autocomplete="name" autofocus="autofocus">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror"
            name="email" value="{{ old('email') }}" required="required" autocomplete="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" placeholder="Kata Sandi"
            class="form-control @error('password') is-invalid @enderror" name="password" required="required"
            autocomplete="new-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input placeholder="Ketik ulang kata sandi" id="password-confirm" type="password" class="form-control"
            name="password_confirmation" required="required" autocomplete="new-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <!-- New Fields -->
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
        <div class="row">
          <div class="col-8">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-center">Login</a>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Registrasi</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection