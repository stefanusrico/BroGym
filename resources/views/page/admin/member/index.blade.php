@extends('layouts.base_admin.base_dashboard')
@section('judul', 'List Member')

@section('content')
<div class="container mt-4">
  <h2>List Member</h2>

  <!-- Display users and add membership button -->
  <table id="usersTable" class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($filteredUsers as $user)
      <tr>
        <td>{{ $user->user->id }}</td>
        <td>{{ $user->user->name }}</td>
        <td>{{ $user->user->email }}</td>
        <td>
          @if (!$user->membership)
          <form action="{{ route('membership.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_user" value="{{ $user->id }}">
            <input type="hidden" name="harga" value="5000">
            <input type="hidden" name="tanggal" value='2023-11-16'>
            <button type="submit" class="btn btn-success">Add Membership</button>
          </form>
          @else
          <span class="badge badge-success">User already has a membership.</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
