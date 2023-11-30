@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Trainer</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('trainers.update', $trainer->id) }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="nama_trainer">Nama Trainer:</label>
            <input type="text" class="form-control" name="nama_trainer" value="{{ $trainer->nama_trainer }}"/>
        </div>

        <div class="form-group">
            <label for="gaji">Gaji:</label>
            <input type="number" class="form-control" name="gaji" value="{{ $trainer->gaji }}"/>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ $trainer->email }}"/>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password"/>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
