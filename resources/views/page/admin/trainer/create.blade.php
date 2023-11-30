@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Trainer</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('trainers.store') }}">
        @csrf
        <div class="form-group">
            <label for="nama_trainer">Nama Trainer:</label>
            <input type="text" class="form-control" name="nama_trainer"/>
        </div>

        <div class="form-group">
            <label for="gaji">Gaji:</label>
            <input type="number" class="form-control" name="gaji"/>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email"/>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password"/>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
