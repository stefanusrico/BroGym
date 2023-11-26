@extends('layouts.base_admin.base_auth')

@section('judul', 'Edit Role')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Edit Role</div>

        <div class="card-body">
          <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PUT')

            <div class="input-group mb-3">
              <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                <option value="" disabled selected>Pilih Role</option>
                @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ old('role', $user->role->name) == $role->name ? 'selected' : '' }}>
                  {{ $role->name }}
                </option>
                @endforeach
              </select>
              @error('role')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  Update Role
                </button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection