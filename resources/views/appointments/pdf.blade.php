<!DOCTYPE html>
<html>
<head>
    <title>Prescription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .details {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h4>Prescription</h4>
        </div>
        <div class="details">
            <p><strong>Doctor:</strong> {{ $appointment->doctor->name }}</p>
            <p><strong>Patient:</strong> {{ $appointment->patient->name }}</p>
            <p><strong>Appointment Date:</strong> {{ $appointment->appointment_date }}</p>
            <p><strong>Prescription Details:</strong> {{ $appointment->prescription->details }}</p>
        </div>
        <div class="footer">
            <p>Generated on: {{ now() }}</p>
        </div>
    </div>
</body>
</html>
