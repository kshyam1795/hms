@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Patient Details</h4>
    <div class="card mt-3">
        <div class="card-header">
            <h2>{{ $patient->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $patient->email }}</p>
            <p><strong>Phone:</strong> {{ $patient->phone }}</p>
            <p><strong>Address:</strong> {{ $patient->address }}</p>
            <p><strong>Date of Birth:</strong> {{ $patient->dob }}</p>
            <p><strong>Gender</strong> {{ $patient->gender }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
