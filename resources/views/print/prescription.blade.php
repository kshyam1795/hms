<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Prescription</title>
    <style>
        
        body {
            background-image: url('http://3.108.33.182/healthplix/public/assets/images/letter_head.jpg'); 
            background-size: cover;
            background-position: top;
            padding: 0px;
            font-family: Arial, sans-serif;
        } 
        .prescription-container {
            position: absolute;
            margin: 0 auto;
            padding: 4% 8%;
            top: 275px;
            text-align: left;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="prescription-container">
        <h2>Prescription for {{ $visit->patient->name }}</h2>
        <p><strong>Date:</strong> {{ $visit->created_at->format('d-M-Y') }}</p>
        <h4>Diagnosis:</h4>
        <p>{{ $visit->diagnosis }}</p>
        <h4>Prescribed Medicines:</h4>
        <table>
            <thead>
                <tr>
                    <th>Medicine</th>
                    <th>Dosage</th>
                    <th>When</th>
                    <th>Where</th>
                    <th>Frequency</th>
                    <th>Duration</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visit->medicines as $medicine)
                    <tr>
                        <td>{{ $medicine->name }}</td>
                        <td>{{ $medicine->dosage }}</td>
                        <td>{{ $medicine->when }}</td>
                        <td>{{ $medicine->where }}</td>
                        <td>{{ $medicine->frequency }}</td>
                        <td>{{ $medicine->duration }}</td>
                        <td>{{ $medicine->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        window.onload = function () {
            window.print(); // Trigger the print dialog
        }
    </script>
</body>
</html>
