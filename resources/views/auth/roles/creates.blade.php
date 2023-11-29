@extends('layouts.base_admin.base_dashboard')

@section('judul', 'Tambah Role')

@section('content')
<div class="container mt-4">
  <h2>Create Role</h2>

  <form method="post" action="{{ route('roles.store') }}" class="mt-3">
    @csrf
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Role Name:</label>
      <div class="col-sm-6">
        <input type="text" name="name" class="form-control" required>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-6 offset-sm-2">
        <button type="submit" class="btn btn-success">Create Role</button>
      </div>
    </div>
  </form>
</div>
@endsection