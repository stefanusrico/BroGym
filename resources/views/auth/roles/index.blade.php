@extends('layouts.app')

@section('content')
<h2>Roles</h2>

<a href="{{ route('roles.create') }}" class="btn btn-success mb-2">Create Role</a>

<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($roles as $role)
    <tr>
      <td>{{ $role->id }}</td>
      <td>{{ $role->name }}</td>
      <td>
        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">Edit</a>
        <!-- Add delete button/form if needed -->
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection