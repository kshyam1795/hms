@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Appointment Details</h4>
    <div class="card mt-3">
        <div class="card-header">
            <h2>Appointment #{{ $appointment->id }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Doctor:</strong> {{ $appointment->doctor->name }}</p>
            <p><strong>Patient:</strong> {{ $appointment->patient->name }}</p>
            <p><strong>Appointment Date:</strong> {{ $appointment->appointment_date }}</p>
            <p><strong>Status:</strong> {{ $appointment->status }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('appointments.generatePDF', $appointment->id) }}" class="btn btn-success">Generate PDF</a>
            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
