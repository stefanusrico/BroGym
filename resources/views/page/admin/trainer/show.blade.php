@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Trainer</h2>

    <table class="table">
        <tr>
            <th>Nama Trainer:</th>
            <td>{{ $trainer->nama_trainer }}</td>
        </tr>
        <tr>
            <th>Gaji:</th>
            <td>{{ $trainer->gaji }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ $trainer->email }}</td>
        </tr>
    </table>

    <a href="{{ route('trainers.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
