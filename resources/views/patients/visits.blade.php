@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Visits for {{ $patient->name }}</h4>
    <a href="{{ route('addpatients.index') }}" class="btn btn-primary">Back to Patients</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Appointment Date</th>
                <th>Doctor</th>
                <th>Service</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->doctor->name }}</td>
                    <td>{{ $appointment->service->name ?? 'N/A' }}</td>
                    <td>{{ $appointment->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
