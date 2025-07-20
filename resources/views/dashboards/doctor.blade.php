@extends('layouts.app')

@section('content')
<style>
    .growats-m-25 {
        margin-top: 45px;
    }
    .navigation {
        top: 0px;
    }
    button#setDateBtn, button#todayDateBtn, button#refreshBtn {
        width: 70px;
        height: 32px;
    }
</style>
<div class="growats-m-25 container-fluid border-bottom py-3 bg-white">
    <div class="row align-items-center">
        <!-- Search Section -->
        <div class="col-md-4 mb-2">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-search"></i> <!-- Bootstrap Icons -->
                </span>
                <input type="text" class="form-control" placeholder="Search" id="searchPatient" style="font-weight: 500;">
            </div>
        </div>

        <!-- Pending and Completed Counters -->
        <div class="col-md-4 mb-2 d-flex align-items-center justify-content-center">
            <span class="text-muted me-2">Pending:</span>
            <span id="pendingCount" class="badge bg-warning text-dark me-4">0</span>
            <span class="text-muted me-2">Completed:</span>
            <span id="completedCount" class="badge bg-success">0</span>
        </div>

        <!-- Action Buttons -->
        <div class="col-md-4 mb-2 d-flex justify-content-md-end justify-content-start">
            <div class="input-group me-2">
                <span class="input-group-text">
                    <i class="bi bi-calendar"></i> <!-- Bootstrap Icons -->
                </span>
                <input type="text" class="form-control" placeholder="Select date" id="selectedDate" style="width: 150px; font-weight: 500;">
            </div>
            <button class="btn btn-primary btn-sm me-2" id="setDateBtn">Set</button>
            <button class="btn btn-secondary btn-sm me-2" id="todayDateBtn">Today</button>
            <button class="btn btn-outline-dark btn-sm" id="refreshBtn">Refresh</button>
        </div>
    </div>
</div>

<!-- Patients Table -->
<div class="table-responsive mt-4">
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Patient Unique ID</th>
                <th>Token</th>
                <th>Patient Name</th>
                <th>Visit Pad</th>
                <th>Recent Visit</th>
                <th>#Visit</th>
                <th>Wait Status</th>
                <th>Purpose</th>
            </tr>
        </thead>
        <tbody id="patientList">
            
           
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        // Initialize date picker
        // $('#selectedDate').datepicker({
        //     dateFormat: 'yy-mm-dd',
        //     autoclose: true
        // });
        
        $('#selectedDate').datepicker({
            dateFormat: 'mm/dd/yy', // Format to MM/DD/YYYY
            changeMonth: true,
            changeYear: true
        });

        // Default today's date
        $('#selectedDate').datepicker('setDate', new Date());
       

        // Set today's date on 'Today' button click
        $('#todayDateBtn').click(function () {
            const today = new Date().toISOString().slice(0, 10);
            $('#selectedDate').val(today);
            fetchPatients(today);
        });

        // Fetch patients for selected date
        $('#setDateBtn').click(function () {
            const selectedDate = $('#selectedDate').val();
            alert(selectedDate);
            fetchPatients(selectedDate);
        });

        // Refresh button functionality
        $('#refreshBtn').click(function () {
            const selectedDate = $('#selectedDate').val();
            fetchPatients(selectedDate);
        });

        // AJAX call to fetch patient data
        // function fetchPatients(date) {
        //     $.ajax({
        //         url: '{{ route("doctor.index") }}',
        //         type: 'GET',
        //         data: {
        //             selected_date: date,
        //         },
        //         success: function (response) {
        //             updatePatientList(response.patientData);
        //         },
        //         error: function (xhr) {
        //             console.error(xhr.responseText);
        //             alert('Failed to fetch patient data.');
        //         }
        //     });
        // }
        function fetchPatients(date) {
            $.ajax({
                url: '{{ route("doctor.index") }}', // Correct route
                type: 'GET',
                data: { selected_date: date },
                success: function (response) {
                    if (response.patientData && response.patientData.length > 0) {
                        updatePatientList(response.patientData);
                    } else {
                        alert(response.message || 'No patients found.');
                        $('#patientList').empty(); // Clear the table
                        $('#pendingCount').text(0);
                        $('#completedCount').text(0);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('Failed to fetch patient data.');
                }
            });
        }


        // Update patient table and counts
        function updatePatientList(patientData) {
            const patientList = $('#patientList');
            patientList.empty();
            let pendingCount = 0;
            let completedCount = 0;
            let token1 = 1;

            $.each(patientData, function (index, patient) {
                patientList.append(`
                    <tr>
                        <td>${patient.uniquePatientID}</td>
                        <td>${token1++}</td>
                        <td>${patient.patientName}</td>
                        <td>
                            <a href="{{url('/visit-pad')}}/${patient.patientId}" class="btn btn-sm btn-outline-primary">
                                Visit Pad
                            </a>
                        </td>
                        <td>${patient.recentVisit}</td>
                        <td>${patient.visits}</td>
                        <td>${patient.waitStatus}</td>
                        <td>${patient.purpose || 'NA'}</td>
                    </tr>
                `);

                if (patient.waitStatus === 'Pending') {
                    pendingCount++;
                } else if (patient.waitStatus === 'Completed') {
                    completedCount++;
                }
            });

            $('#pendingCount').text(pendingCount);
            $('#completedCount').text(completedCount);
        }

        // Trigger today's fetch on load
        $('#todayDateBtn').trigger('click');
    });
</script>
@endsection
