<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .bill-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .bill-details, .deposits {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        .bill-details th, .bill-details td, .deposits th, .deposits td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .bill-details th, .deposits th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="bill-header">
        <h1 style="float:left">Billing Details</h1>
        <button onclick="window.print()" class="btn btn-primary" style="float: right">Print</button>
    </div>

    <h2>Patient Information</h2>
    <p><strong>Name:</strong> {{ $patient->name }}</p>
    <p><strong>Phone:</strong> {{ $patient->phone }}</p>
    <p><strong>Email:</strong> {{ $patient->email }}</p>

    <h2>Billing Summary</h2>
    <table class="bill-details">
        <tr>
            <th>Total Amount</th>
            <th>Paid Amount</th>
            <th>Balance Amount</th>
            <th>Billing Date</th>
        </tr>
        <tr>
            <td>{{ $billing->total_amount }}</td>
            <td>{{ $billing->paid_amount }}</td>
            <td>{{ $billing->balance_amount }}</td>
            <td>{{ $billing->created_at->format('d-m-Y') }}</td>
        </tr>
    </table>

    <h2>Deposits</h2>
    <table class="deposits">
        <tr>
            <th>Deposit ID</th>
            <th>Amount</th>
            <th>Mode</th>
            <th>Date</th>
        </tr>
        @foreach ($deposits as $deposit)
        <tr>
            <td>{{ $deposit->id }}</td>
            <td>{{ $deposit->amount }}</td>
            <td>{{ $deposit->mode }}</td>
            <td>{{ $deposit->created_at->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
