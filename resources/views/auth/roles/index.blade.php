@extends('layouts.base_admin.base_dashboard')

@section('judul', 'Tambah Role')

@section('content')
<div class="container mt-4">
  <h2>Roles</h2>

  <a href="{{ route('roles.create') }}" class="btn btn-success mb-2">Create Role</a>

  <table class="table table-bordered">
    <thead class="thead-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($roles as $role)
      <tr>
        <td>{{ $role->id }}</td>
        <td>{{ $role->name }}</td>
        <td>
          <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>
          <form action="{{ route('roles.destroy', $role->id) }}" method="post" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm"
              onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="3" class="text-center">No roles found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection