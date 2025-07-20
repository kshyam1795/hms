@extends('layouts.app')

@section('content')
<style>
    .growats-m-26 {
        margin-top: 50px;
    }
    .navigation {
        top: 0px;
    }
    button.btn.btn-warning.btn-sm.col-lg-2.rounded-pill.shadow-sm {
    width: 100%;
    height: 30px;
    top: 30px;
    background: yellow;
}
    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
    }
    .card-text {
        font-size: 2rem;
        font-weight: 600;
    }
    .card {
        border-radius: 15px;
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: scale(1.05);
    }
    .card-body {
    height: 150px;
}
    
</style>

@php
    use Carbon\Carbon;
@endphp

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container-fluid">
    <h4 class="growats-m-26">Doctor's Report</h4>

    <!-- Filters -->
    <form action="{{ route('doctor.report', $doctorId) }}" method="get">
        <div class="row">
            <div class="form-group col-lg-5">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date', Carbon::now()->startOfMonth()->format('Y-m-d')) }}">
            </div>
            <div class="form-group col-lg-5" >
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date', Carbon::now()->format('Y-m-d')) }}">
            </div>
            <button type="submit" class="btn btn-warning  btn-sm col-lg-2 rounded-pill shadow-sm">
                <i class="fas fa-filter"></i> Apply Filter
            </button>
        </div>
    </form>

    <div class="row">
        <div class="col-md-12 mt-4">
            <h3>Summary</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Total Appointments</h5>
                            <p class="card-text display-4 text-dark">{{ $appointments->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-warning">Pending Appointments</h5>
                            <p class="card-text display-4 text-dark">{{ $pendingAppointments }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-success">Completed Appointments</h5>
                            <p class="card-text display-4 text-dark">{{ $completedAppointments }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-info">Total Billing</h5>
                            <p class="card-text display-4 text-dark">{{ $totalBill }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Charts -->
    <div class="row">
        <div class="col-md-4">
            <canvas id="appointmentsChart"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="billingChart"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="patientChart"></canvas>
        </div>
    </div>

    <div class="container mt-4">
        <h3>Reports</h3>
        <div class="row">
            <div class="col-md-3">
                <button class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#appointmentsModal">
                    View Appointments
                </button>
            </div>
            <div class="col-md-3">
                <button class="btn btn-info btn-block" data-bs-toggle="modal" data-bs-target="#billingModal">
                    View Billing History
                </button>
            </div>
            <div class="col-md-3">
                <button class="btn btn-success btn-block" data-bs-toggle="modal" data-bs-target="#depositsModal">
                    View Deposits
                </button>
            </div>
            <div class="col-md-3">
                <button class="btn btn-warning btn-block" data-bs-toggle="modal" data-bs-target="#visitsModal">
                    View Patient Visits
                </button>
            </div>
        </div>
    </div>
    
    <!-- Appointments Modal -->
    <div class="modal fade" id="appointmentsModal" tabindex="-1" aria-labelledby="appointmentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentsModalLabel">Appointments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Service</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->patient->name ?? '' }}</td>
                                    <td>{{ $appointment->service->name ?? '' }}</td>
                                    <td>{{ $appointment->appointment_date ?? '' }}</td>
                                    <td>{{ $appointment->appointment_time ?? '' }}</td>
                                    <td>{{ $appointment->status ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Billing Modal -->
    <div class="modal fade" id="billingModal" tabindex="-1" aria-labelledby="billingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="billingModalLabel">Billing History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Total Amount</th>
                                <th>Paid Amount</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($billings as $billing)
                                <tr>
                                    <td>{{ $billing->patient->name ?? '' }}</td>
                                    <td>{{ $billing->total_amount ?? '' }}</td>
                                    <td>{{ $billing->paid_amount ?? '' }}</td>
                                    <td>{{ $billing->balance_amount ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Deposits Modal -->
    <div class="modal fade" id="depositsModal" tabindex="-1" aria-labelledby="depositsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="depositsModalLabel">Deposits</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Deposit Amount</th>
                                <th>Mode of Payment</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deposits as $deposit)
                                <tr>
                                    <td>{{ $deposit->bill->appointment->patient->name ?? '' }}</td>
                                    <td>{{ $deposit->amount ?? '' }}</td>
                                    <td>{{ $deposit->mode ?? '' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($deposit->created_at)->format('Y-m-d') ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Visits Modal -->
    <div class="modal fade" id="visitsModal" tabindex="-1" aria-labelledby="visitsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visitsModalLabel">Patient Visits</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Visit Date</th>
                                <th>Complaints</th>
                                <th>Diagnosis</th>
                                <th>Tests</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visits as $visit)
                                <tr>
                                    <td>{{ $visit->patient->name ?? '' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($visit->created_at)->format('Y-m-d') ?? '' }}</td>
                                    <td>{{ $visit->complaints ?? '' }}</td>
                                    <td>{{ $visit->diagnosis ?? '' }}</td>
                                    <td>{{ $visit->tests ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var appointmentChartData = @json($appointmentChartData);
    var billingChartData = @json($billingChartData);
    var patientChartData = @json($patientChartData);

    var ctx1 = document.getElementById('appointmentsChart').getContext('2d');
    var ctx2 = document.getElementById('billingChart').getContext('2d');
    var ctx3 = document.getElementById('patientChart').getContext('2d');

    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: appointmentChartData.map(data => data.date),
            datasets: [{
                label: 'Appointments',
                data: appointmentChartData.map(data => data.total),
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false
            }]
        }
    });

    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: billingChartData.map(data => data.date),
            datasets: [{
                label: 'Total Billing',
                data: billingChartData.map(data => data.total),
                borderColor: 'rgba(153, 102, 255, 1)',
                fill: false
            }]
        }
    });

    new Chart(ctx3, {
        type: 'line',
        data: {
            labels: patientChartData.map(data => data.date),
            datasets: [{
                label: 'Patients',
                data: patientChartData.map(data => data.total),
                borderColor: 'rgba(255, 159, 64, 1)',
                fill: false
            }]
        }
    });
</script>
@endsection
