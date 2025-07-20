@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Generate Reports</h4>
    <form action="{{ route('reports.generate') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="report_type">Report Type</label>
            <select name="report_type" class="form-control">
                <option value="appointments">Appointments</option>
                <!-- Add other report types -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>
</div>
@endsection
