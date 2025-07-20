<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Bills for Patient</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd0;
            padding: 4px;
            text-align: left;
        }
        th {
            background-color: #f2f2f200;
        }
        .total {
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .header {
            text-align: justify;
            margin: 30px 0;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>
<body>
    <div class="header">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-4">
                    <img src="{{ asset('assets/images/logo.png')}}" alt="" srcset="" style="width: 100%;">

                </div>
                <div class="col-8">
                    <h2>DR. BEHL'S SKIN INSTITUTE. </h2>
                    <p>Zamrudpur, N Block, Greater Kailash-1 Opp Lady Shree Ram College, New Delhi 110048 <br>
                        Phone: 08448662349</p>
                </div>
            </div>
            <div class="row" style="text-align: center">
                <div class="col-lg-12">
                    <h2 class="text-left">Token: {{ $token }} | Room Number: {{ $roomNumber }} </h2>
                    <h4 style="float:left">All Bill cum Receipt </h4>                           
                    
                 
                    {{-- <p >Patient Name: {{ $bills->first()->patient->name ?? 'Patient' }} |  Patient ID: {{ $bills->first()->patient->uniquePatientID ?? 'N/A' }}</p> --}}
                    <button onclick="window.print()" class="btn btn-primary" style="float: right">Print</button>
                </div>
            </div>
            <hr>
             
            @php
                use Illuminate\Support\Facades\DB;
                $appointments = DB::table('appointments')->where('uniquePatientID', $bills->first()->patient->uniquePatientID)->get();
                // $doctors = DB::table('doctors')->where('doctor_id', $appointments->doctor_id)->first();

            @endphp
            <div class="row">
                <div class="col-lg-12">
                    <table>
                        <tr>
                            <th>Patient Name :</th><td>{{ $bills->first()->patient->name ?? 'Patient' }}</td>
                            
                        </tr>
                        <tr>
                            <th>Mobile Number :</th><td>{{ $bills->first()->patient->phone ?? 'NA' }}</td>
                            <th>Bill Date :</th><td>{{ \Carbon\Carbon::parse($bills->first()->created_at)->format('d M, Y') }}</td>
                        </tr>
                        <tr>
                            <th>Patient ID :</th><td>{{ $bills->first()->patient->uniquePatientID ?? 'N/A' }}</td>
                            <th>Bill Number :</th><td>{{ $bills->first()->id }}</td>
                        </tr>
                        <tr>
                            <th>Referred by :</th><td>{{ $doctors->name ?? 'Doctor' }}</td>
                            <th>Bill Status :</th><td>{{ $bills->first()->balance_amount=='0' ?'Paid':'Unpaid' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>



            <div class="row">
                <div class="col-lg-12">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th colspan="5" style="text-align: left">Service Particulars</th>
                                <th>Price</th>
                                <th>Net. Price</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                                
                                
                            
                            @forelse ($bills as $index => $bill)
                                @foreach($appointments as $appointment)
                                    @php
                                        $serviceName= DB::table('services')->where('id', $appointment->service_id)->first();
                                    @endphp
                                @endforeach
                                
                                <tr style="border-bottom: 1px solid #000">
                                    <td>{{ $index + 1 }}</td>
                                    <td colspan="5" style="text-align: left">{{ $serviceName->name }}</td>
                                    <td >{{ number_format($bill->total_amount, 2) }}</td>
                                    <td >{{ number_format($bill->paid_amount, 2) }}</td>
                                    {{-- <td >{{ number_format($bill->balance_amount, 2) }}</td>
                                    <td>{{ $bill->created_at->format('d-m-Y') }}</td> --}}
                                </tr>
                                
                                <tr style="border-bottom: 1px solid #000">
                                    
                                        @if ($bill->deposits->isNotEmpty())
                                            @foreach ($bill->deposits as $deposit)
                                            <td colspan="6">
                                                <strong>Payment Mode: </strong>
                                                    @if($deposit->mode=='0')
                                                    {{'CASH'}}
                                                    @elseif($deposit->mode=='1')
                                                    {{'CARD'}}
                                                    @elseif($deposit->mode=='2')
                                                    {{'M-WALLET'}}
                                                    @elseif($deposit->mode=='3')
                                                    {{'CHEQUE'}}
                                                    @elseif($deposit->mode=='4')
                                                    {{'BANK TRANSFER'}}
                                                    @elseif($deposit->mode=='5')
                                                    {{'INSURANCE'}}
                                                    @endif
                                                <br>
                                            {{ number_format($bill->paid_amount, 2) }}


                                            </td>
                                            <td colspan="2" style="text-align: right">
                                                <ul style="list-style-type:none; ">
                                                
                                                    <li>Billed Amount   :{{ number_format($deposit->amount, 2) }}</li>
                                                    <li>Final Amount    :{{ number_format($bills->sum('total_amount'), 2) }}</li>
                                                    <li>Recieved Amount :{{ number_format($bills->sum('paid_amount'), 2) }}</li>
                                                    <li>Balance Amount  :{{ number_format($bills->sum('balance_amount'), 2) }}</li>
                                                
                                            </ul>
                                            @endforeach
                                        @else
                                            No deposits found for this bill.
                                        @endif
                                    </td>
                                </tr>
                            @empty
                            
                                <tr>
                                    <td colspan="6" class="text-center">No bills found for this patient.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
                        
        </div>
    </div>

    

    {{-- <div class="total">
        <p>Total Bills: {{ $bills->count() }}</p>
        <p>Total Amount: {{ number_format($bills->sum('total_amount'), 2) }}</p>
        <p>Total Paid: {{ number_format($bills->sum('paid_amount'), 2) }}</p>
        <p>Total Balance: {{ number_format($bills->sum('balance_amount'), 2) }}</p>
    </div> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>
