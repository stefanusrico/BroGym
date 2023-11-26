@extends('layouts.base_admin.base_dashboard')
@section('judul', 'List Member')

<!-- Add these lines to your <head> section -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>


<script>
$(document).ready(function() {
  $('#usersTable').DataTable();
});
</script>


@section('content')
<!-- Display users and add membership button -->
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($usersWithPayments as $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>
        @if (!$user->membership)
        <form action="{{ route('membership.store') }}" method="POST">
          @csrf
          <input type="hidden" name="id_user" value="{{ $user->id }}">
          <input type="hidden" name="harga" value="5000">
          <input type="hidden" name="tanggal" value='2023-11-16'>
          <button type="submit">Add Membership</button>
        </form>
        @else
        User already has a membership.
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection