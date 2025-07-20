@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 65px;" >
    <h4>Superadmin Dashboard</h4>
    
    <!-- Filter Section -->
    <form method="GET" action="{{ route('superadmin.dashboard') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $startDate ?? now()->format('Y-m-d') }}">
            </div>
            <div class="col-md-3">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $endDate ?? now()->format('Y-m-d') }}">
            </div>
            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Date Range Information -->
    <p>
        

        @if(isset($startDate) && isset($endDate))
            Showing data from {{ $startDate }} to {{ $endDate }}
        @else
            Showing overall data
        @endif
    </p>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5>Total Collection</h5>
                    <h2>₹{{ $totalCollection ?? '0' }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5>Pending Payments</h5>
                    <h2>{{ $pendingPayments ?? '0' }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-4">
        <div class="col-md-6">
            <canvas id="appointmentsChart"></canvas>
        </div>
    </div>

    <!-- Detailed Appointments Table -->
    <div class="table-responsive">
        <h5>Appointments</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $appointments = session('appointments', collect([]));
                @endphp
                @if($appointments->isNotEmpty())
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->created_at->format('Y-m-d') ?? '' }}</td>
                            <td>{{ $appointment->patient->name ?? '' }}</td>
                            <td>{{ $appointment->doctor->name ?? '' }}</td>
                            <td>{{ $appointment->status ?? '' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No appointments found for the selected date range.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js Integration -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Appointments Over Time Chart
    const appointmentsData = {!! json_encode($chartData['dates'] ?? []) !!};
    const collectionsData = {!! json_encode($chartData['collections'] ?? []) !!};
    // const appointmentsData = {{-- json_encode($chartData['dates']) --}};
    const ctx1 = document.getElementById('appointmentsChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: Object.keys(appointmentsData),
            datasets: [{
                label: 'Appointments',
                data: Object.values(appointmentsData),
                borderColor: 'blue',
                fill: false,
            }]
        }
    });
</script>
@endsection
