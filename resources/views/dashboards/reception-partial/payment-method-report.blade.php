@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Payment Method Report</h4>
                </div>
                <div class="card-body">
                    <!-- Filter Form -->
                    <form action="{{ route('reports.payment-methods') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="filterType">Filter By</label>
                                    <select class="form-control" id="filterType" name="filterType" onchange="toggleDateInputs()">
                                        <option value="all" {{ $filterType == 'all' ? 'selected' : '' }}>All Time</option>
                                        <option value="today" {{ $filterType == 'today' ? 'selected' : '' }}>Today</option>
                                        <option value="weekly" {{ $filterType == 'weekly' ? 'selected' : '' }}>Last 7 Days</option>
                                        <option value="monthly" {{ $filterType == 'monthly' ? 'selected' : '' }}>Last 30 Days</option>
                                        <option value="3months" {{ $filterType == '3months' ? 'selected' : '' }}>Last 3 Months</option>
                                        <option value="6months" {{ $filterType == '6months' ? 'selected' : '' }}>Last 6 Months</option>
                                        <option value="yearly" {{ $filterType == 'yearly' ? 'selected' : '' }}>This Year</option>
                                        <option value="custom" {{ $filterType == 'custom' ? 'selected' : '' }}>Custom Range</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 date-range" style="{{ $filterType == 'custom' ? '' : 'display: none;' }}">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3 date-range" style="{{ $filterType == 'custom' ? '' : 'display: none;' }}">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Apply Filter</button>
                                <a href="{{ route('reports.payment-methods') }}" class="btn btn-secondary ml-2">Reset</a>
                            </div>
                        </div>
                    </form>

                    <!-- Summary Cards -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Collections</h5>
                                    <h3 class="card-text">₹{{ number_format($totalAmount, 2) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Transactions</h5>
                                    <h3 class="card-text">{{ $totalDeposits }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Average Transaction</h5>
                                    <h3 class="card-text">₹{{ $totalDeposits > 0 ? number_format($totalAmount / $totalDeposits, 2) : '0.00' }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Breakdown -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Payment Method Breakdown</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">

                                            @php
                                                $paymentModes = [
                                                    0 => 'CASH',
                                                    1 => 'CARD',
                                                    2 => 'M-WALLET',
                                                    3 => 'CHEQUE',
                                                    4 => 'BANK TRANSFER',
                                                    5 => 'INSURANCE',
                                                ];
                                            @endphp
                                            <thead>
                                                <tr>
                                                    <th>Payment Method</th>
                                                    <th>Transactions</th>
                                                    <th>Amount</th>
                                                    <th>Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($paymentMethodSummary as $method => $data)
                                                    <tr>
                                                        <td>{{ $paymentModes[$method] ?? 'Unknown' }}</td> <!-- Map mode number to text -->
                                                        <td>{{ $data['count'] }}</td>
                                                        <td>₹{{ number_format($data['total_amount'], 2) }}</td>
                                                        <td>{{ $totalAmount > 0 ? number_format(($data['total_amount'] / $totalAmount) * 100, 2) : '0.00' }}%</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Payment Method Distribution</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="paymentMethodChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Daily Trend Chart -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Daily Collection Trend</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="dailyTrendChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Transactions -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Recent Transactions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Patient</th>
                                                    <th>Bill ID</th>
                                                    <th>Payment Method</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentDeposits as $deposit)
                                                <tr>
                                                    <td>{{ $deposit->created_at->format('d M Y, h:i A') }}</td>
                                                    <td>
                                                        @if($deposit->bill && $deposit->bill->patient)
                                                            {{ $deposit->bill->patient->name }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td>{{ $deposit->billing_id }}</td>
                                                    <td>{{ $paymentModes[$deposit->mode] ?: 'Unknown' }}</td>
                                                    <td>₹{{ number_format($deposit->amount, 2) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function toggleDateInputs() {
        const filterType = document.getElementById('filterType').value;
        const dateRangeInputs = document.querySelectorAll('.date-range');
        
        if (filterType === 'custom') {
            dateRangeInputs.forEach(el => el.style.display = 'block');
        } else {
            dateRangeInputs.forEach(el => el.style.display = 'none');
        }
    }

    // Payment Method Chart
    const paymentMethodData = @json($paymentMethodChartData);
    const paymentMethodCtx = document.getElementById('paymentMethodChart').getContext('2d');
    
    new Chart(paymentMethodCtx, {
        type: 'pie',
        data: {
            labels: paymentMethodData.map(item => item.mode),
            datasets: [{
                data: paymentMethodData.map(item => item.amount),
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796',
                    '#5a5c69', '#6610f2', '#fd7e14', '#20c9a6', '#e83e8c', '#6f42c1'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ₹${value.toLocaleString()} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Daily Trend Chart
    const dailyTrendData = @json($dailyDepositTrend);
    const dailyTrendCtx = document.getElementById('dailyTrendChart').getContext('2d');
    
    new Chart(dailyTrendCtx, {
        type: 'line',
        data: {
            labels: dailyTrendData.map(item => item.date),
            datasets: [{
                label: 'Daily Collections',
                data: dailyTrendData.map(item => item.amount),
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderWidth: 2,
                pointBackgroundColor: '#4e73df',
                pointBorderColor: '#fff',
                pointHoverRadius: 5,
                pointHoverBackgroundColor: '#4e73df',
                pointHoverBorderColor: '#fff',
                pointHitRadius: 10,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₹' + value.toLocaleString();
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Collections: ₹' + context.raw.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
