<!DOCTYPE html>
<html>
<head>
    <title>Bill Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .bill-table { width: 100%; border-collapse: collapse; }
        .bill-table th, .bill-table td { border: 1px solid #ddd; padding: 8px; }
        .bill-table th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Bill Receipt</h2>
    <table>
        <tr>
            <td><strong>Patient Name:</strong> {{ $patient->name }}</td>
            <td><strong>Mobile Number:</strong> {{ $patient->phone }}</td>
        </tr>
        <tr>
            <td><strong>Patient ID:</strong> {{ $patient->id }}</td>
            <td><strong>Referred By:</strong> {{ $bill->referred_by }}</td>
        </tr>
        <tr>
            <td><strong>Bill Date:</strong> {{ $bill->created_at->format('d-M-Y h:i A') }}</td>
            <td><strong>Bill Number:</strong> {{ $bill->id }}</td>
        </tr>
        <tr>
            <td><strong>Bill Status:</strong> {{ $bill->paid_amount >= $bill->total_amount ? 'PAID' : 'PENDING' }}</td>
        </tr>
    </table>
    
    <h3>Service Details</h3>
    <table class="bill-table">
        <thead>
            <tr>
                <th>Service Particulars</th>
                <th>Price</th>
                <th>Net Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bill->services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->price }}</td>
                    <td>{{ $service->net_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Payment Details</h3>
    <table>
        <tr>
            <td><strong>Payment Mode:</strong> {{ $lastDeposit->mode }}</td>
        </tr>
        <tr>
            <td><strong>Billed Amount:</strong> {{ $bill->total_amount }}</td>
        </tr>
        <tr>
            <td><strong>Final Amount:</strong> {{ $bill->final_amount }}</td>
        </tr>
        <tr>
            <td><strong>Received Amount:</strong> {{ $bill->paid_amount }}</td>
        </tr>
        <tr>
            <td><strong>Balance Amount:</strong> {{ $bill->balance_amount }}</td>
        </tr>
    </table>
</body>
</html>
