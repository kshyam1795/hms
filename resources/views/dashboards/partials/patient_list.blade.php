@if ($patients->count() > 0)
{{-- {{dd($patients)}} --}}
    @foreach($patients as $patient)
        @php
            $visit = $patient->latest_visit; // Get latest visit
        @endphp
        <div class="patientBillBlock">
            <div class="row appntListItems">
                <div type="button" class="col-md-1 patient-active hoverbg hplx-log-input-cls" onclick="openPatientModal('{{ $patient->id }}', '{{ $patient->uniquePatientID }}', '{{ $patient->name }}', '{{ $patient->phone }}', '{{ $patient->age }}', '{{ $patient->gender }}')">
                    {{ $patient->uniquePatientID }}
                </div>
                <div class="col-2 d-flex ellipse patient-active hoverbg hplx-log-input-cls" onclick="openPatientModal('{{ $patient->id }}', '{{ $patient->uniquePatientID }}', '{{ $patient->name }}', '{{ $patient->phone }}', '{{ $patient->age }}', '{{ $patient->gender }}')" id="pnameRow{{ $patient->id }}">
                    <div class="p-0">
                        <div class="appnt_token">
                            <span class="appnt_token_hole"></span>{{ $patient->appointments->first()->token ?? '' }}
                        </div>
                    </div>
                    <div class="pl-3 bookedPatName">{{ $patient->name }}</div>
                </div>
                <div class="col-md-1">
                    <span style="cursor:pointer;color:#408080" class="hplx-log-input-cls" data-event-set="false" data-input-event="click" data-event-title="patient popup print bill by oid" onclick="printBillByoid({{ $patient->billings->first()->id ?? '' }},'frontdesk_all_bills',{{ $patient->id }}, {{$patient->appointments->first()->token ?? ''}}, '1')">
                        <i class="fa fa-print"></i>
                    </span>
                    &nbsp;
                    <b>
                        @php
                            $billing = $patient->billings->first();
                            $deposit = $billing?->deposits->sum('amount') ?? 0;
                            $total = $billing?->total_amount ?? 0;
                            $discount = $billing?->discount ?? 0;
                            $tax = $billing?->tax ?? 0;
                            $balance = $total - $deposit - $discount + $tax;
                        @endphp
                        <a href="#" style="cursor:pointer;color:green;" data-toggle="modal" data-target="#addDeposit" class="hplx-log-input-cls" data-event-set="false" data-input-event="click" data-event-title="pay frontdesk" 
                        onclick="preparePayFrontDesk(
                                '{{ $billing->id ?? '' }}',
                                '{{ $patient->uniquePatientID }}',
                                '{{ $patient->name }}',
                                '{{ $patient->id }}',
                                {{ $total }},
                                {{ $deposit }},
                                {{ $balance }},
                                {{ $discount }},
                                {{ $tax }}
                            )">
                            @if (!$patient->appointments->first()->payment_completed )
                             <span style="color: red">   
                                 {{ $patient->billings->first()->total_amount ?? 'N/A' }}
                             </span>
                            @else
                                <span style="color: inherit;">   
                                    {{ $patient->billings->first()->total_amount ?? 'N/A' }}
                                </span> 
                            @endif
                        </a>
                    </b>
                </div>
                <div class="col-md-1">
                    <div class="dropdown simpleBillsDivBOOKED" style="margin-top:2px;">
                        <button class="btn btn-primary dropdown-toggle info-dropdown-btn" type="button" style="line-height:1px;" title="For {{ $patient->appointments->first()->doctor->name ?? 'Unknown Doctor' }}">
                            <i class="fa fa-info-circle 2x" aria-hidden="true" title="Vitals, Lab tests and Prescription"></i>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" style="margin-top:-1px; position: absolute; top: 100%; left: 0; z-index: 1000; display: none; min-width: 10rem; padding: 0.5rem 0; background-color: #fff; border: 1px solid rgba(0,0,0,.15); border-radius: 0.25rem;">
                            <li>
                                <a class="a-link hplx-log-input-cls" data-event-set="false" data-input-event="click" data-event-title="dropdown patient vitals" id="vitals-{{ $patient->id }}" style="cursor:pointer;" onclick="preparePatientVitals('{{ $patient->id }}','{{ $patient->appointments->first()->id ?? '' }}','{{ $patient->age }}','{{ $patient->gender }}','{{ $patient->appointments->first()->id ?? '' }}')" data-toggle="modal" data-target="#addPatientVitals">
                                    <i class="fa fa-medkit 2x" aria-hidden="true" title="Vitals"></i> 
                                    <span>Vitals</span>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="modal" data-target="#testModal" class="a-link newTest hplx-log-input-cls" data-event-set="false" data-input-event="click" data-event-title="dropdown test results" data-template="COMMON-TESTS" data-cmt="no" data-from="frontdesk" style="cursor:pointer;" data-patient-gender="{{ $patient->gender == 'Male' ? 0 : 1 }}" data-patient-gender-str="{{ $patient->gender }}" data-patient-age="{{ $patient->age }}" data-patient-id="{{ $patient->id }}" data-patient_person_id="{{ $patient->id }}" data-org-id="{{ $patient->org_id }}" data-patient-name="{{ $patient->name }}" data-open-default-heading="">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    <span>Test result (new)</span>
                                </a>
                            </li>
                            <li>
                                {{-- <a class="a-link hplx-log-input-cls" data-event-set="false" data-input-event="click" data-event-title="dropdown print prescription" style="cursor:pointer;" onclick="window.open('{{ route('print.prescription', $visit->id) }}', '_blank')">
                                    <i class="fa fa-file" aria-hidden="true"></i>
                                    <span>Prescription</span>
                                </a> --}}

                                @if (!empty($visit) && isset($visit->id))
                                    <a class="a-link hplx-log-input-cls" 
                                    data-event-set="false" 
                                    data-input-event="click" 
                                    data-event-title="dropdown print prescription" 
                                    style="cursor:pointer;" 
                                    onclick="window.open('{{ route('print.prescription', $visit->id) }}', '_blank')">
                                    <i class="fa fa-file" aria-hidden="true"></i>
                                    <span> Prescription</span>
                                    </a>
                                @else
                                    <span class="text-muted">No Prescription</span>
                                @endif

                                
                            </li>
                            <li>
                                <a class="a-link hplx-log-input-cls" data-event-set="false" data-input-event="click" data-event-title="dropdown attachment" style="cursor:pointer;" onclick="addAttachment('{{ $patient->id }}','{{ $patient->org_id }}')" title="For {{ $patient->appointments->first()->doctor->name ?? 'Unknown Doctor' }}">
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                                    <span>Attachments</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <table class="simpletable appnt-table">
                        <tbody>
                            {{-- dd($patient->appointments->first()->appointment_time)--}}
                            <tr status="BOOKED" class="hoverbg simpleBillsBOOKED" data-toggle="modal" data-target="#addAppointment" 
                                onclick="prepareAppointmentModalExistings(
                                    '{{ $patient->appointments->first()->id ?? '' }}',
                                    '{{ $patient->name }}',
                                    '{{ $patient->id }}',
                                    '{{ $patient->appointments->first()->doctor->id ?? '' }}',
                                    '{{ $patient->appointments->first()->service->id ?? '' }}',
                                    '{{ \Carbon\Carbon::parse($patient->appointments->first()->appointment_time ?? '')->format('h:i A') }}',  
                                    '{{ \Carbon\Carbon::parse($patient->appointments->first()->appointment_time ?? '')->format('H:i') }}',  
                                    '{{ \Carbon\Carbon::parse($patient->appointments->first()->appointment_date)->format('d/m/Y') }}',  
                                    '{{ \Carbon\Carbon::parse($patient->appointments->first()->appointment_date)->format('Y-m-d') }}',  
                                    '{{ $patient->appointments->first()->total_amount ?? 0 }}'
                                )" title="Edit Appointment Details">
                                <td style="width:60px;"></td>
                                <td style="width:120px;">
                                    <span id="appntTime-{{ $patient->appointments->first()->id ?? '' }}" style="text-transform: uppercase;">{{ $patient->appointments->first() ? \Carbon\Carbon::parse($patient->appointments->first()->appointment_time)->format('h:i A') : 'N/A' }}</span>
                                </td>
                                <td style="width:120px;">
                                    <span id="appntstate-{{ $patient->appointments->first()->id ?? '' }}" style="text-transform: uppercase;color: #1e56d8;">
                                        @if ($patient->appointments->first()->status=='1')
                                            {{ 'Arrived'}}
                                        @elseif ($patient->appointments->first()->status=='2')
                                            {{ 'Booked'}}
                                        @elseif ($patient->appointments->first()->status=='3')
                                            {{ 'On-going'}}
                                        @elseif ($patient->appointments->first()->status=='4')
                                            {{ 'Reviewed'}}
                                        @else
                                            {{ 'NA' }}
                                        @endif 
                                    </span>
                                </td>
                                <td style="width: 150px;">
                                    <span style="width:200px" class="ellipse">{{ $patient->appointments->first()->doctor->name ?? 'Unknown Doctor' }}</span>
                                </td>
                                <td style="width:150px;">{{ $patient->appointments->first()->service->name ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="appointmentModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="appointmentForm">
                            @csrf
                            <input type="hidden" id="appointmentId" name="appointmentId">
                            <input type="hidden" id="patientId" name="patientId">
        
                            <p>Patient Name: <span id="name"></span></p>
        
                            <div class="form-group">
                                <label for="doctorId">Doctor</label>
                                <select class="form-control" id="doctorId" name="doctorId">
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" 
                                            @if($doctor->id == old('doctorId', $patient->appointments->first()->doctor->id)) selected @endif>
                                            {{ $doctor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="serviceName">Service</label>
                                <select class="form-control" id="serviceName" name="serviceName">
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" >
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
        
                            <div class="form-group">
                                <label for="appointmentTime">Time</label>
                                <input type="time" class="form-control" id="appointmentTime" name="appointmentTime">
                                <p>Appointment Time (Display): <span id="appointmentTimeDisplay"></span></p>
                            </div>
        
                            <div class="form-group">
                                <label for="appointmentDate">Date</label>
                                <input type="date" class="form-control" id="appointmentDate" name="appointmentDate">
                                <p>Appointment Date (Display): <span id="appointmentDateDisplay"></span></p>
                            </div>
        
                            <div class="form-group">
                                <label for="total-amount">Amount</label>
                                <p class="form-control" id="total-amount"></p>
                            </div>
        
                            <button type="submit" class="btn btn-primary">Save Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pay Front Desk Modal -->
        <div id="payFrontDeskModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pay Front Desk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="payFrontDeskForm">
                            @csrf
                            <input type="hidden" id="billingId" name="billingId">
                            <input type="hidden" id="patientId" name="patientId">
                            <p>Patient Name: <span id="patientName"></span></p>
                            <p>Total Amount: <span id="totalAmount"></span></p>
                            <p>Paid Amount: <span id="paidAmount"></span></p>
                            <p>Balance Amount: <span id="balanceAmount"></span></p>
                            <p>Discount Amount: <span id="discountAmount"></span></p>
                            <p>Tax Amount: <span id="taxAmount"></span></p>
                            <div class="form-group">
                                <label for="deposit-amount">Deposit Amount</label>
                                <input type="number" class="form-control" id="PB-deposit-amount" name="deposit-amount" required>
                            </div>
                            <div class="form-group">
                                <label for="deposit-mode">Deposit Mode</label>
                                <select class="form-control" id="PB-deposit-mode" name="deposit-mode" required>
                                    <option value="0">CASH</option>
                                    <option value="1">CARD</option>
                                    <option value="2">M-WALLET</option>
                                    <option value="3">CHEQUE</option>
                                    <option value="4">BANK TRANSFER</option>
                                    <option value="5">INSURANCE</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-primary" style="background-color: #0077df;" onclick="addDepositAmount('PB-')">Add Deposit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@else
    <p>No records found</p>
@endif
