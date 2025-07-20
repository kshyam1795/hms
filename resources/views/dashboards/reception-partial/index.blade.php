@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-50">
    <h1>Receptionist Reports</h1>

    <!-- Filters Section -->
    <form method="GET" action="{{ route('rece.reports.index') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <select class="form-select" name="filterType" onchange="this.form.submit()">
                <option value="all" {{ request('filterType') === 'all' ? 'selected' : '' }}>All</option>
                <option value="weekly" {{ request('filterType') === 'weekly' ? 'selected' : '' }}>Last 7 Days</option>
                <option value="monthly" {{ request('filterType') === 'monthly' ? 'selected' : '' }}>Last Month</option>
                <option value="3months" {{ request('filterType') === '3months' ? 'selected' : '' }}>Last 3 Months</option>
                <option value="6months" {{ request('filterType') === '6months' ? 'selected' : '' }}>Last 6 Months</option>
                <option value="yearly" {{ request('filterType') === 'yearly' ? 'selected' : '' }}>This Year</option>
                <option value="custom" {{ request('filterType') === 'custom' ? 'selected' : '' }}>Custom Range</option>
            </select>
        </div>
        <div class="col-md-3 form-group">
            <input type="date" class="form-select" name="start_date" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-3 form-group">
            <input type="date" class="form-select" name="end_date" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-3 form-group">
            <input type="text" class="form-select" name="doctor_name" placeholder="Search by Doctor Name" value="{{ request('doctor_name') }}">
        </div>
        <div class="col-md-3 ">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <div class="row">
        <!-- Billing Summary -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Billing Summary</h5>
                    <p><strong>Total Billed:</strong> ₹{{ number_format($allBillied, 2) }}</p>
                    <p><strong>Total Collected:</strong> ₹{{ number_format($allCollected, 2) }}</p>
                    <p><strong>Total Outstanding:</strong> ₹{{ number_format($allOutstanding, 2) }}</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#billingModal">View All Bills</button>
                </div>
            </div>
        </div>
        <div class="col-md-9 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Billing Trends</h5>
                    <canvas id="billingChart" height="100"></canvas>
                </div>
            </div>
        </div>
        

        <!-- Appointments Summary -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Appointments Summary</h5>
                    <canvas id="appointmentChart" height="100"></canvas>
                    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#appointmentModal">View Appointment Details</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Billing Modal -->
<div class="modal fade" id="billingModal" tabindex="-1" aria-labelledby="billingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="billingModalLabel">All Bills</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Patient</th>
                            <th>Total Amount</th>
                            <th>Paid Amount</th>
                            <th>Balance</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $index => $appointment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $appointment->patient->name ?? 'N/A' }}</td>
                            <td>
                                @if ($appointment->billing)
                                    ₹{{ number_format($appointment->billing->total_amount, 2) }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if ($appointment->billing)
                                    ₹{{ number_format($appointment->billing->paid_amount, 2) }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if ($appointment->billing)
                                    ₹{{ number_format($appointment->billing->balance_amount, 2) }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $appointment->created_at->format('d-m-Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
<!-- Appointment Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentModalLabel">Appointments by Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Doctor Name</th>
                            <th>Total</th>
                            <th>Booked</th>
                            <th>Arrived</th>
                            <th>Ongoing</th>
                            <th>Reviewed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointmentStats as $stats)
                        <tr>
                            <td>{{ $stats['doctor_name'] }}</td>
                            <td>{{ $stats['total'] }}</td>
                            <td>{{ $stats['booked'] }}</td>
                            <td>{{ $stats['arrived'] }}</td>
                            <td>{{ $stats['ongoing'] }}</td>
                            <td>{{ $stats['reviewed'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
<script>
    const billingCtx = document.getElementById('billingChart').getContext('2d');
    const billingGraphData = @json($billingGraphData);

    const months = billingGraphData.map(data => data.month);
    const totalAmounts = billingGraphData.map(data => data.total);
    const collectedAmounts = billingGraphData.map(data => data.collected);
    const outstandingAmounts = billingGraphData.map(data => data.outstanding);

    const billingChart = new Chart(billingCtx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Total Billed',
                    data: totalAmounts,
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    fill: true
                },
                {
                    label: 'Total Collected',
                    data: collectedAmounts,
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    fill: true
                },
                {
                    label: 'Total Outstanding',
                    data: outstandingAmounts,
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.2)',
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Amount (₹)'
                    }
                }
            }
        }
    });
</script>
<script>
    // Appointment Chart
    const ctx = document.getElementById('appointmentChart').getContext('2d');
    const appointmentChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total', 'Booked', 'Arrived', 'Ongoing', 'Reviewed'],
            datasets: [{
                label: 'Appointments',
                data: [
                    {{ $appointments->count() }},
                    {{ $appointments->where('status', '2')->count() }},
                    {{ $appointments->where('status', '1')->count() }},
                    {{ $appointments->where('status', '3')->count() }},
                    {{ $appointments->where('status', '4')->count() }}
                ],
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8', '#dc3545'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
