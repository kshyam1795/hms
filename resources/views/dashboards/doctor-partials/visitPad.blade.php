@extends('layouts.app')

@section('content')



<style>
    
    .growats-m-25 {
        margin-top: 45px;
    }
    .navigation {
        top: 0px;
    }
    .container-fluid {
        padding: 20px;
        background-color: #fff0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .header-section {
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .header-section h2 {
        font-size: 22px;
        font-weight: 600;
        margin: 0;
        padding: 4px 0;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-inline {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    .autocomplete-dropdown {
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        z-index: 1000;
    }
    .autocomplete-dropdown div {
        padding: 8px;
        cursor: pointer;
    }
    .autocomplete-dropdown div:hover {
        background-color: #f0f0f0;
    }
    .action-buttons {
        margin-top: 30px;
        text-align: right;
    }
    .action-buttons .btn {
        padding: 10px 20px;
        margin-left: 10px;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    /* Past Visits Styling */
    .past-visits-section {
        display: flex;
        margin-top: 20px;
    }
    /* Left-side timeline styles */
    /* Container for the timeline */
    .timeline {
        width: 120px;
        position: relative;
    }

    /* Styling for the vertical line */
    .timeline-line {
        position: absolute;
        left: 40px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #ccc;
        z-index: 1; /* Ensures the line stays behind the circle */
        transform: translateX(-50%); /* Centers the line exactly behind the circles */
    }

    /* Styling for the circle */
    .timeline .visit-date {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #fff;
        color: #333;
        font-weight: bold;
        cursor: pointer;
        margin-bottom: 10px;
        z-index: 2; /* Ensures the circle stays above the line */
        position: relative; /* Keeps it positioned correctly within the timeline */
    }

    /* Hover effect for the circle */
    .timeline .visit-date:hover {
        background-color: #123f56;
        color: white;
    }
    /* Right-side visit details styles */
    .visit-details {
        flex: 1;
        padding-left: 40px;
        /* border-left: 2px solid #ccc; */
    }
    .visit-details .visit-entry {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .visit-details .visit-entry h4 {
        margin-bottom: 10px;
    }
    .visit-details .medicines-table {
        width: 100%;
        margin-top: 10px;
        border-collapse: collapse;
    }
    .visit-details .medicines-table th,
    .visit-details .medicines-table td {
        padding: 10px;
        border: 1px solid #dee2e6;
        text-align: left;
    }
    .visit-actions {
        display: flex;
        gap: 15px;
        margin-top: 10px;
    }
    .visit-actions button {
        background-color: transparent;
        border: none;
        color: #007bff;
        cursor: pointer;
    }
    .visit-actions button:hover {
        text-decoration: underline;
    }
    .complaint-tag {
        display: inline-block;
        margin: 5px;
        padding: 5px 10px;
        background: #e0e0e0;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }
    .complaint-tag:hover {
        background: #d6d6d6;
    }
</style>
<style>
    .dropdown-menu {
        border: 1px solid #ccc;
        background: white;
        z-index: 1000;
        padding: 5px;
        border-radius: 4px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    }
    .dropdown-item {
        padding: 8px 12px;
        cursor: pointer;
    }
    .dropdown-item:hover {
        background-color: #f0f0f0;
    }
</style>

<style>
    .prescription-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .prescription-table th,
    .prescription-table td {
        border: 1px solid #ddd;
        padding: 8px;
        vertical-align: middle;
    }

    .prescription-table th {
        background-color: #f8f8f8;
        text-align: left;
        font-weight: 600;
    }

    .prescription-table td select,
    .prescription-table td input {
        width: 100%;
        border: none;
        border-bottom: 1px solid #ccc;
        outline: none;
        padding: 4px 6px;
        background: transparent;
    }

    .prescription-table td input:focus {
        border-bottom: 1px solid #007bff;
    }

    .generic-note {
        font-size: 10px;
        color: #999;
        margin-top: 2px;
    }

    .delete-row {
        color: red;
        cursor: pointer;
        font-size: 16px;
        padding: 2px 8px;
    }

    #add-medicine-btn {
        margin-top: 10px;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="container-fluid growats-m-25">
    
            <!-- Flash Success Message -->
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            {{-- <div class="col-lg-1" style="background-color: #fff;padding: 4px 0px;">
                <ul class="left-side">
                    <li>Documents</li>
                    <li>New Field</li>
                </ul>
            </div> --}}
            <div class="col-lg-12" style="background-color:#ffffff4f">
                <form id="visitForm" method="POST" action="{{ route('saveVisit') }}">
                    @csrf <!-- Laravel's CSRF protection token -->
            
                    <!-- Patient Header -->
                    <div class="header-section">
                        <h2>{{ $patient->name }} ({{ $patient->age }} Y, {{ $patient->gender == 0 ? 'Male' : ($patient->gender == 1 ? 'Female' : 'Others') }})</h2>
                        <p>ID: {{ $patient->uniquePatientID }} | Referred by: {{ $patient->referred_by }} | Contact: {{ $patient->phone }}</p>
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    </div>
                    <input type="hidden" name="doctor_id" id="doctorID" value="{{$doctor->id}}">
            
                    <!-- Complaints and Diagnosis Section -->
                    <div class="form-section">
                        <div class="row">
                            <!-- Genetic History -->
                            <div class="col-md-2 form-group position-relative">
                                <h4 for="genetic_history">Genetic History</h4>
                            </div>
                            <div class="col-md-10 form-group position-relative">
                                <textarea name="genetic_history" placeholder="Genetic History" class="form-control">{{ $patient->genetic_history ?? '' }}</textarea>
                                <div id="genetic_history-dropdown" class="autocomplete-dropdown"></div>
                            </div>                             
                            <div class="col-md-2 form-group position-relative">
                                <h4 for="complaints">Complaints</h4>
                            </div>
                            <div class="col-md-10 form-group position-relative">
                                <input type="text" name="complaints" id="complaints" class="form-control" placeholder="Enter complaints" required>
                                <div id="complaints-dropdown" class="autocomplete-dropdown"></div>
                            </div>
            
                            <div class="col-md-2 form-group position-relative">
                                <h4 for="diagnosis">Diagnosis</h4>
                                
                            </div>
                            <div class="col-md-10 form-group position-relative">
                                
                                <input type="text" name="diagnosis" id="diagnosis" class="form-control" placeholder="Enter diagnosis" required>
                                <div id="diagnosis-dropdown" class="autocomplete-dropdown"></div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Medicine Table -->
                    <div class="medicine-table bg-white p-3 rounded">
                        <h5>Prescribed Medicines</h5>
                        <table class="prescription-table" id="medicine-table">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Medicine</th>
                                    <th>Dosage</th>
                                    <th>When</th>
                                    <th>Frequency</th>
                                    <th>Duration</th>
                                    <th>Notes</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="medicine-rows">
                                @include('dashboards.doctor-partials.medicine-row', ['index' => 0])
                            </tbody>
                        </table>
                        <div id="dropdown-options" class="dropdown-menu" style="display:none; position:absolute; z-index:1000; background:white; border:1px solid #ccc; max-height:150px; overflow-y:auto;"></div>

                        <button type="button" class="btn btn-outline-primary btn-sm" id="add-medicine-btn">+ Add Medicine</button>
                    </div>


            
                    <!-- Advice and Tests Requested Section -->
                    <div class="form-section" style="padding: 10px 0; margin:15px 0">
                        <div class="row">
                            <div class="col-md-2 form-group position-relative">
                                <h5 for="tests">Tests Requested</h5>
                                
                            </div>
                            <div class="col-md-10 form-group position-relative">
                                
                                <input type="text" name="tests" id="tests" class="form-control" placeholder="Enter tests requested">
                                <div id="tests-dropdown" class="autocomplete-dropdown"></div>
                            </div>
                            <div class="col-md-2 form-group">
                                <h5 for="advice">Advice</h5>
                                
                            </div>
                            <div class="col-md-10 form-group">
                                
                                <textarea name="advice" id="advice" class="form-control" rows="3" placeholder="Advice"></textarea>
                            </div>
                        </div>
                    </div>
            
                    <!-- Next Visit and Referred To Section -->
                    <div class="form-section bg-white" style="padding: 10px 15px; margin:15px -12px 0">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="next-visit">Next Visit</label>
                                <div class="form-inline">
                                    <input type="number" id="next-visit-number" class="form-control" placeholder="No of">
                                    <select id="next-visit-unit" class="form-control">
                                        <option value="days">Days</option>
                                        <option value="weeks">Weeks</option>
                                        <option value="months">Months</option>
                                    </select>
                                    <span>or</span>
                                    <input type="date" id="next-visit-date" name="nextVisit" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12" style="display: block">
                                <label for="referred-to">Referred to</label>
                                <div class="form-inline">
                                    <input type="text" class="form-control" id="doctor-name" placeholder="Doctor Name">
                                    <input type="text" class="form-control" id="specialty" placeholder="Specialty" readonly>
                                    <div class="form-inline">
                                        <input type="text" class="form-control" id="phone-code" placeholder="+91" style="width: 60px;" readonly>
                                        <input type="text" class="form-control" id="phone-no" placeholder="Phone No" readonly>
                                    </div>
                                    <input type="email" class="form-control" id="doctor-email" placeholder="Email" readonly>
                                </div>
                            </div>
                            
                        </div>
                    </div>
            
                    <!-- Action Buttons -->
                    <div class="action-buttons bg-white" style="padding: 10px 15px; margin:0px -12px">
                        <button type="submit" class="btn btn-primary growats-btn-color" id="save-btn">Save</button>
                        <button type="button" class="btn btn-danger growats-btn-color" id="end-consultation-btn">End Consultation</button>
                    </div>
                    
                    <!-- Past Visits Section -->
                    <div class="past-visits-section">
                        <!-- Timeline (Left side) -->
                        <div class="timeline">
                            <div class="timeline-line"></div>
                            @foreach ($pastVisits as $visit)
                                <div class="visit-date" data-visit-id="{{ $visit->id }}" onclick="showVisitDetails({{ $visit->id }})">
                                    {{ $visit->created_at->format('d M') }}
                                </div>
                            @endforeach
                        </div>

                        <!-- Visit Details (Right side) -->
                        <div class="visit-details" id="visit-details">
                            @foreach ($pastVisits as $visit)
                                <div class="visit-entry" id="visit-{{ $visit->id }}" style="display: none;">
                                    <h4>{{ $visit->created_at->format('d-M-Y') }} By: {{ $visit->doctor->name ?? 'NA' }}</h4>
                                    <!-- Actions -->
                                    <div class="visit-actions" style="float: right">
                                        <button class="whatsapp-sms"
                                            data-visit-id="{{ $visit->id }}"
                                            data-phone="{{ $visit->patient->phone }}"
                                            data-name="{{ $visit->patient->name }}">
                                            <i class="fab fa-whatsapp"></i> WhatsApp & SMS
                                        </button>
                                        <button class="print" onclick="window.open('{{ route('print.prescription', $visit->id) }}', '_blank')"><i class="fas fa-print"></i> Print</button>
                                        <button class="email"><i class="fas fa-envelope"></i> Email</button>
                                    </div>
                                    <div>
                                        <h4>Complaints:</h4>
                                        <p>{{ $visit->complaints }}</p>
                                    </div>
                                    <div><h4>Diagnosis:</h4><p> {{ $visit->diagnosis }}</p></div>
                                    <div>
                                        <h3>Tests:</h3>
                                        @if ($visit->tests)
                                            <p>{{ $visit->tests }}</p>
                                        @else
                                            <p>No tests available for this visit.</p>
                                        @endif
                                    </div>

                                    <h5>Rx:</h5>
                                    <table class="medicines-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Medicine</th>
                                                <th>Dosage</th>
                                                <th>When</th>
                                                 
                                                <th>Frequency</th>
                                                <th>Duration</th>
                                                <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($visit->medicines as $index => $medicine)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $medicine->name }}</td>
                                                    <td>{{ $medicine->dosage }}</td>
                                                    <td>{{ $medicine->when }}</td>
                                                     
                                                    <td>{{ $medicine->frequency }}</td>
                                                    <td>{{ $medicine->duration }}</td>
                                                    <td>{{ $medicine->notes }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <p><strong>Next Visit:</strong> {{ $visit->next_visit ? \Carbon\Carbon::parse($visit->next_visit)->format('d-M-Y') : 'Not set' }}</p>

                                    
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>


    
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    function showVisitDetails(visitId) {
        // Hide all visit entries
        document.querySelectorAll('.visit-entry').forEach(function (entry) {
            entry.style.display = 'none';
        });

        // Show the selected visit entry
        document.getElementById('visit-' + visitId).style.display = 'block';
    }

    // Automatically show the first visit's details when the page loads
    window.onload = function () {
        const firstVisit = document.querySelector('.visit-date');
        if (firstVisit) {
            showVisitDetails(firstVisit.dataset.visitId);
        }
    };
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    const complaintsInput = document.getElementById('complaints');
    const diagnosisInput = document.getElementById('diagnosis');
    const testsInput = document.getElementById('tests');

    const complaintsDropdown = document.getElementById('complaints-dropdown');
    const diagnosisDropdown = document.getElementById('diagnosis-dropdown');
    const testsDropdown = document.getElementById('tests-dropdown');

    // Hidden inputs to hold the selected values for submission
    const complaintsHiddenInput = createHiddenInput('complaints[]');
    const diagnosisHiddenInput = createHiddenInput('diagnosis[]');
    const testsHiddenInput = createHiddenInput('tests[]');

    complaintsInput.parentElement.appendChild(complaintsHiddenInput);
    diagnosisInput.parentElement.appendChild(diagnosisHiddenInput);
    testsInput.parentElement.appendChild(testsHiddenInput);

    const complaintsContainer = createContainer('complaints-container');
    const diagnosisContainer = createContainer('diagnosis-container');
    const testsContainer = createContainer('tests-container');

    complaintsInput.parentElement.appendChild(complaintsContainer);
    diagnosisInput.parentElement.appendChild(diagnosisContainer);
    testsInput.parentElement.appendChild(testsContainer);

    complaintsInput.addEventListener('input', function () {
        fetchSuggestions(complaintsInput.value, '{{route("get.complaints")}}', complaintsDropdown, item =>
            addItem(item, complaintsContainer, complaintsHiddenInput)
        );
    });

    diagnosisInput.addEventListener('input', function () {
        fetchSuggestions(diagnosisInput.value, '{{route("get.diagnosis")}}', diagnosisDropdown, item =>
            addItem(item, diagnosisContainer, diagnosisHiddenInput)
        );
    });

    testsInput.addEventListener('input', function () {
        fetchSuggestions(testsInput.value, '{{route("get.test")}}', testsDropdown, item =>
            addItem(item, testsContainer, testsHiddenInput)
        );
    });

    function fetchSuggestions(query, url, dropdown, callback) {
        if (query.length > 0 && dropdown) {
            fetch(`${url}?query=${query}`)
                .then(response => response.json())
                .then(data => showDropdown(data, dropdown, callback))
                .catch(error => console.log(error));
        } else if (dropdown) {
            dropdown.innerHTML = ''; // Clear the dropdown if query is empty
        }
    }

    function showDropdown(data, dropdown, callback) {
        dropdown.innerHTML = ''; // Clear any previous data

        data.forEach(item => {
            let div = document.createElement('div');
            div.textContent = item;
            div.addEventListener('click', function () {
                callback(item);
                dropdown.innerHTML = ''; // Clear the dropdown after selection
            });
            dropdown.appendChild(div);
        });
    }

    function addItem(item, container, hiddenInput) {
        const tag = createTag(item, container, hiddenInput);
        container.appendChild(tag);

        // Add the value to the hidden input
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = hiddenInput.name;
        input.value = item;
        hiddenInput.appendChild(input);
    }

    function createContainer(id) {
        const container = document.createElement('div');
        container.id = id;
        container.style.marginTop = '10px';
        return container;
    }

    function createHiddenInput(name) {
        const input = document.createElement('div');
        input.style.display = 'none'; // Invisible container for hidden inputs
        input.name = name;
        return input;
    }

    function createTag(text, container, hiddenInput) {
        const tag = document.createElement('span');
        tag.textContent = text;
        tag.className = 'item-tag';
        tag.style.margin = '5px';
        tag.style.padding = '5px 10px';
        tag.style.background = '#e0e0e0';
        tag.style.borderRadius = '5px';
        tag.style.display = 'inline-block';

        const removeBtn = document.createElement('span');
        removeBtn.textContent = ' ✖';
        removeBtn.style.color = 'red';
        removeBtn.style.marginLeft = '5px';
        removeBtn.style.cursor = 'pointer';

        removeBtn.addEventListener('click', function () {
            container.removeChild(tag);

            // Remove the associated hidden input
            Array.from(hiddenInput.children).forEach(input => {
                if (input.value === text) {
                    hiddenInput.removeChild(input);
                }
            });
        });

        tag.appendChild(removeBtn);
        return tag;
    }


    


    document.querySelectorAll('.whatsapp-sms').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const visitId = btn.dataset.visitId;
            const phone = btn.dataset.phone.replace(/\D/g, '');
            const name = btn.dataset.name;

            fetch(`/prescription/pdf-url/${visitId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const message = `Hello ${name},\nYour prescription is ready.\nClick the link below to download:\n${data.url}`;
                        const whatsappUrl = `https://wa.me/91${phone}?text=${encodeURIComponent(message)}`;
                        window.open(whatsappUrl, '_blank');
                    } else {
                        alert('Failed to generate prescription.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Something went wrong while generating prescription.');
                });
        });
    });

});

document.addEventListener('DOMContentLoaded', function () {
        const numberInput = document.getElementById('next-visit-number');
        const unitSelect = document.getElementById('next-visit-unit');
        const dateInput = document.getElementById('next-visit-date');

        // Function to calculate the next visit date based on number and unit
        function calculateNextVisit() {
            const number = parseInt(numberInput.value, 10);
            const unit = unitSelect.value;
            let nextDate = new Date();

            if (isNaN(number) || number <= 0) {
                return; // Do nothing if the number is invalid
            }

            switch (unit) {
                case 'days':
                    nextDate.setDate(nextDate.getDate() + number);
                    break;
                case 'weeks':
                    nextDate.setDate(nextDate.getDate() + (number * 7));
                    break;
                case 'months':
                    nextDate.setMonth(nextDate.getMonth() + number);
                    break;
            }

            // Format the date as YYYY-MM-DD and set it in the input field
            const formattedDate = nextDate.toISOString().split('T')[0];
            dateInput.value = formattedDate;
        }

        // Listen to changes on number input or unit select
        numberInput.addEventListener('input', calculateNextVisit);
        unitSelect.addEventListener('change', calculateNextVisit);
    });


    document.addEventListener('DOMContentLoaded', function() {
        const doctorNameInput = document.getElementById('doctor-name');
        
        doctorNameInput.addEventListener('input', function() {
            const doctorName = doctorNameInput.value;
            
            // If doctor name is not empty, fetch the doctor details
            if (doctorName.length > 2) {  // Trigger after typing at least 3 characters
                fetchDoctorDetails(doctorName);
            }
        });
        
        // Function to fetch doctor details from the server
        function fetchDoctorDetails(name) {
            fetch(`/get-doctor-details?name=${name}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Populate fields with the returned data
                        document.getElementById('specialty').value = data.specialty || '';
                        document.getElementById('phone-code').value = data.phoneCode || '';
                        document.getElementById('phone-no').value = data.phoneNo || '';
                        document.getElementById('doctor-email').value = data.email || '';
                    } else {
                        // Clear the fields if doctor not found
                        clearDoctorDetails();
                    }
                })
                .catch(error => {
                    console.error('Error fetching doctor details:', error);
                    clearDoctorDetails();
                });
        }

        // Function to clear doctor details
        function clearDoctorDetails() {
            document.getElementById('specialty').value = '';
            document.getElementById('phone-code').value = '';
            document.getElementById('phone-no').value = '';
            document.getElementById('doctor-email').value = '';
        }
    });



</script>

<script>

    

    // document.getElementById('add-medicine-btn').addEventListener('click', function() {
    //     const medicineRows = document.getElementById('medicine-rows');
    //     const newIndex = medicineRows.querySelectorAll('tr').length;

    //     const newRow = `
    //         <tr>
    //             <td> ${newIndex + 1} </td>
    //             <td>
    //                 <select class="form-control medicine-select" name="medicines[0][name]" required>
    //                     <option value="">Select Medicine</option>
    //                     @foreach($medicineMasters as $medicine)
    //                         <option value="{{ $medicine->name }}">{{ $medicine->name }}</option>
    //                     @endforeach
    //                 </select>
    //             </td>
    //             <td><input type="text" name="medicines[0][dosage]" class="form-control dropdown-input dosage" ></td>
    //             <td><input type="text" name="medicines[0][when]" class="form-control dropdown-input when" ></td>
    //             <td><input type="text" name="medicines[0][where]" class="form-control dropdown-input where" ></td>
    //             <td><input type="text" name="medicines[0][frequency]" class="form-control dropdown-input frequency" ></td>
    //             <td><input type="text" name="medicines[0][duration]" class="form-control dropdown-input duration" ></td>
    //             <td><input type="text" name="medicines[0][notes]" class="form-control"></td>
    //             <td><span class="delete-btn fa fa-trash" ></span></td>
    //         </tr>
    //     `;
        
    //     medicineRows.insertAdjacentHTML('beforeend', newRow);
    //     applyDeleteEvent();
    //     applyStaticValues();
    // });

    // function applyDeleteEvent() {
    //     document.querySelectorAll('.delete-btn').forEach(function(btn) {
    //         btn.addEventListener('click', function() {
    //             btn.closest('tr').remove();
    //         });
    //     });
    // }
    
    // const dosageValues = ['100mg', '200mg', '500mg'];
    // const whenValues = ['Morning', 'Afternoon', 'Evening'];
    // const whereValues = ['Home', 'Clinic'];
    // const frequencyValues = ['Once a day', 'Twice a day', 'Thrice a day'];
    // const durationValues = ['1 week', '2 weeks', '1 month'];

    

    // function applyStaticValues() {
    //     document.querySelectorAll('.medicine-select').forEach(function(select) {
    //         select.addEventListener('change', function() {
    //             const row = select.closest('tr');
    //             row.querySelector('.dosage').value = dosageValues[Math.floor(Math.random() * dosageValues.length)];
    //             row.querySelector('.when').value = whenValues[Math.floor(Math.random() * whenValues.length)];
    //             row.querySelector('.where').value = whereValues[Math.floor(Math.random() * whereValues.length)];
    //             row.querySelector('.frequency').value = frequencyValues[Math.floor(Math.random() * frequencyValues.length)];
    //             row.querySelector('.duration').value = durationValues[Math.floor(Math.random() * durationValues.length)];
    //         });
    //     });
    // }

    // applyDeleteEvent();
    // applyStaticValues();
    // const dropdown = document.getElementById("dropdown-medicine");
    // const options = {
    //     dosage: ['1-0-0', '0-0-1', '1-0-1', '1-1-1', '1-1-0','0-1-0','0-1-1','0-0-0-1'],
    //     when: ['Before Food', 'After Food', 'Before Breakfast', 'After Breakfast', 'Before Lunch', 'After Lunch', 'Before Dinner', 'After Dinner', 'Empty Stomach', 'Bed Time'],
    //     where: ['Home', 'Clinic'],
    //     frequency: ['daily', 'alternate day', 'weekly','for night', 'monthly', 'stat', 'sos', 'weekly twice', 'weekly thrice'],
    //     duration: ['2 days','2 weeks','2 months','2 years']
    // };

    // document.querySelectorAll(".dropdown-input").forEach(input => {
    //     input.addEventListener("focus", function () {
    //         showDropdown(this);
    //     });

    //     input.addEventListener("input", function () {
    //         showDropdown(this);
    //     });
    // });

    // function showDropdown(input) {
    //     const fieldType = input.classList.contains("dosage") ? "dosage" :
    //                      input.classList.contains("when") ? "when" :
    //                      input.classList.contains("where") ? "where" :
    //                      input.classList.contains("frequency") ? "frequency" :
    //                      input.classList.contains("duration") ? "duration" : null;

    //     if (!fieldType) return;

    //     dropdown.innerHTML = options[fieldType].map(value => `<div class="dropdown-item">${value}</div>`).join("");
    //     dropdown.style.display = "block";

    //     const rect = input.getBoundingClientRect();
    //     dropdown.style.left = rect.left + "px";
    //     dropdown.style.top = rect.bottom + "px";

    //     document.querySelectorAll(".dropdown-item").forEach(item => {
    //         item.addEventListener("click", function () {
    //             input.value = this.innerText;
    //             dropdown.style.display = "none";
    //         });
    //     });
    // }

    // document.addEventListener("click", function (event) {
    //     if (!event.target.classList.contains("dropdown-input") && !event.target.classList.contains("dropdown-item")) {
    //         dropdown.style.display = "none";
    //     }
    // });

    

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dropdown = document.getElementById('dropdown-options');
    let activeInput = null;

    const options = {
        dosage: ['1-0-0', '0-0-1', '1-0-1', '1-1-1', '1-1-0','0-1-0','0-1-1','0-0-0-1'],
        when: ['Before Food', 'After Food', 'Before Breakfast', 'After Breakfast', 'Before Lunch', 'After Lunch', 'Before Dinner', 'After Dinner', 'Empty Stomach', 'Bed Time'],
        where: ['Home', 'Clinic'],
        frequency: ['daily', 'alternate day', 'weekly','for night', 'monthly', 'stat', 'sos', 'weekly twice', 'weekly thrice'],
        duration: ['2 days','2 weeks','2 months','2 years']
    };

    function getFieldType(input) {
        if (input.classList.contains('dosage')) return 'dosage';
        if (input.classList.contains('when')) return 'when';
        if (input.classList.contains('where')) return 'where';
        if (input.classList.contains('frequency')) return 'frequency';
        if (input.classList.contains('duration')) return 'duration';
        return null;
    }

    function showDropdown(input) {
        const type = getFieldType(input);
        if (!type || !options[type]) return;

        dropdown.innerHTML = '';
        options[type].forEach(value => {
            const div = document.createElement('div');
            div.textContent = value;
            div.style.padding = '6px 12px';
            div.style.cursor = 'pointer';
            div.classList.add('dropdown-item');
            div.addEventListener('mousedown', () => {
                input.value = value;
                dropdown.style.display = 'none';
            });
            dropdown.appendChild(div);
        });

        const rect = input.getBoundingClientRect();
        dropdown.style.left = `${rect.left + window.scrollX}px`;
        dropdown.style.top = `${rect.bottom + window.scrollY}px`;
        dropdown.style.width = `${rect.width}px`;
        dropdown.style.display = 'block';
    }

    document.addEventListener('focusin', function (e) {
        if (e.target.classList.contains('dropdown-input')) {
            activeInput = e.target;
            showDropdown(activeInput);
        }
    });

    document.addEventListener('click', function (e) {
        if (!dropdown.contains(e.target) && !e.target.classList.contains('dropdown-input')) {
            dropdown.style.display = 'none';
        }
    });

    // Optional: refresh events after adding rows dynamically
    window.refreshDropdownInputs = function () {
        document.querySelectorAll('.dropdown-input').forEach(input => {
            input.setAttribute('autocomplete', 'off');
        });
    };

    refreshDropdownInputs(); // call on load
});
</script>


<script>
let rowIndex = 1;

function initializeSelect2(selector) {
    $(selector).select2({
        tags: true,
        placeholder: 'Select or type medicine',
        minimumInputLength: 1,
        ajax: {
            url: '/medicine-suggestions',
            dataType: 'json',
            delay: 250,
            data: params => ({ term: params.term }),
            processResults: data => ({ results: data.map(name => ({ id: name, text: name })) }),
            cache: true
        },
        createTag: params => {
            return {
                id: params.term,
                text: params.term,
                newOption: true
            };
        }
    }).on('select2:select', function (e) {
        if (e.params.data.newOption) {
            const name = e.params.data.text;
            const select = $(this);
            $.post('/medicines/add', { name, _token: '{{ csrf_token() }}' }, function (res) {
                if (res.success) {
                    const newOption = new Option(res.medicine.name, res.medicine.name, true, true);
                    select.append(newOption).trigger('change');
                }
            });
        }
    });
}

function addMedicineRow() {
    rowIndex = parseInt(rowIndex);
    const rowHtml = `{!! str_replace(['\n', "'"], [' ', "\\'"], trim(view('dashboards.doctor-partials.medicine-row')->with('index', '${rowIndex}'))) !!}`;
    $('#medicine-rows').append(rowHtml);
    initializeSelect2(`#medicine-name-${rowIndex}`);
    rowIndex++;
}

$(document).ready(function () {
    initializeSelect2('#medicine-name-0');

    $('#add-medicine-btn').on('click', addMedicineRow);

    $('#medicine-rows').on('click', '.delete-row', function () {
        $(this).closest('tr').remove();
    });
});
</script>
@endsection
