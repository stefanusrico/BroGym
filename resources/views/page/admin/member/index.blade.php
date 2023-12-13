<!-- Your Blade View -->

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
        <td>{{ $user->user->email }} </td>
        <td>
          @if (!$user->membership)
          <!-- Form for adding membership -->
          <form id="addMembershipForm" action="{{ route('membership.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_user" value="{{ $user->user->id }}">
            <input type="hidden" name="id_pembayaran" value="{{ $user->id }}">
            <!-- Button to trigger confirmation modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmationModal">
              Add Membership
            </button>
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

<!-- Confirmation Modal -->
<div class="modal" tabindex="-1" role="dialog" id="confirmationModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to add membership?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" id="confirmAddMembership">Yes</button>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
  $('#confirmAddMembership').on('click', function() {
    // Hide the modal
    $('#confirmationModal').modal('hide');
    // Submit the form
    $('#addMembershipForm').submit();
  });
});
</script>

@endsection