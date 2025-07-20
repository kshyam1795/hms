<style>
    .badge {
        display: inline-block;
        min-width: 2.1em;
        padding: .5em;
        border-radius: 3%;
        font-size: 0.9rem;
        text-align: center;
        background: #1779ba;
        color: #fefefe;
    }
</style>
<div class="tab-content w-100 p-0 m-0 min-h-400 d-flex " style="margin:0 auto;padding-top: 0;">
    <div class="patientSendSMS bg-primary max-w-100px bg-primary" id="epbPatietAppnts">  
        <ul class="nav nav-pills mdb-left-bar-tab d-flex flex-column">
            <li class="nav-item text-center"><a class="nav-link active" data-toggle="pill" href="#patDetailTodayAppnt">Today's Appoint</a></li>
            <li class="nav-item text-center"><a class="nav-link" data-toggle="pill" href="#patDetailAllAppnt">All Appoint</a></li>
        </ul>
    </div>

    <div id="patDetailTodayAppnt" class="tab-pane px-3 mt-3 mb-5 w-100 in active">
        <div class="col-md-12 hidden" id="pb_appntList_display">
            <div id="pb_appntList">
                <div class="col-md-12 p-0">
                    <table class="simpletable appnt-table table">
                        <tbody>
                            @foreach($appointments as $appointment)
                                @foreach ($appointment->appointmentServices as $as)
                                    @if($appointment->appointment_date == \Carbon\Carbon::today()->format('Y-m-d'))
                                        <tr>
                                            <td>{{ $appointment->appointment_date }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                            <td>{{ $appointment->status }}</td>
                                            <td>{{ $appointment->doctor->name }}</td>
                                            <td style="max-width: 100px; word-wrap: break-word; white-space: normal;">{{ $as->service->name }}</td>
                                            <td >
                                                <a href="{{ route('appointments.edit', ['id' => $appointment->id, 'service_id' => $as->service->id]) }}" class="btn btn-sm btn-warning">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 mt-2 px-0">
                <button class="btn btn-primary pull-right text-uppercase waves-effect waves-light" id="pb_addNewAppointment">ADD NEW APPOINTMENT</button>
            </div>
            <div class="row col-md-12">
                <hr>
            </div>
        </div>
        @foreach($appointments as $appointment)
            <form class="row w-75 mx-auto no-gutters mb-4" method="POST" action="{{ route('appointments.update', $appointment->id) }}">
                @csrf
                @method('PUT')

                {{-- Hidden Fields --}}
                <input type="hidden" name="uniquePatientID" value="{{ $appointment->uniquePatientID }}">
                <input type="hidden" name="patient_id" value="{{ $appointment->patient_id }}">

                {{-- Doctor --}}
                <div class="col-md-6 form-group">
                    <label>Doctor</label>
                    <select class="form-control" name="doctor_id">
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Service --}}
                <div class="col-md-6 form-group">
                    <label>Service</label>
                    <select class="form-control" name="service_id">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ $appointment->service_id == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Appointment Date --}}
                <div class="col-md-6 form-group">
                    <label>Date</label>
                    <input type="date" class="form-control" name="appointment_date"
                        value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}">
                </div>

                {{-- Time --}}
                <div class="col-md-6 form-group">
                    <label>Time</label>
                    <input type="text" class="form-control" name="appointment_time"
                        value="{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}">
                </div>

                {{-- Duration --}}
                <div class="col-md-6 form-group">
                    <label>Duration (mins)</label>
                    <select class="form-control" name="duration">
                        @foreach([10,30,45,60,90,120,150,180] as $duration)
                            <option value="{{ $duration }}" {{ $appointment->duration == $duration ? 'selected' : '' }}>
                                {{ $duration }} mins
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Status --}}
                <div class="col-md-6 form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="0" {{ $appointment->status == 0 ? 'selected' : '' }}>BOOKED</option>
                        <option value="3" {{ $appointment->status == 1 ? 'selected' : '' }}>ARRIVED</option>
                        <option value="5" {{ $appointment->status == 2 ? 'selected' : '' }}>ON-GOING</option>
                        <option value="1" {{ $appointment->status == 3 ? 'selected' : '' }}>REVIEWED</option>
                        <option value="2" {{ $appointment->status == 5 ? 'selected' : '' }}>CANCELLED</option>
                    </select>
                </div>

                {{-- Submit --}}
                <div class="col-md-12 text-right mt-2">
                    <button type="submit" class="btn btn-success">Update Appointment</button>
                </div>
            </form>
        @endforeach


    </div><!-- END of Today's Appnt -->

    <div id="patDetailAllAppnt" class="tab-pane px-3 mt-3 mb-5 w-100">
        <div id="pb_allAppntList">
            <div class="col-md-12 p-0">
                <table class="simpletable appnt-table table">
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M y') }}</td>
                                <td><span id="appntTime-{{ $appointment->id }}" style="text-transform: uppercase;">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span></td>
                                <td><span id="appntstate-{{ $appointment->id }}" style="text-transform: uppercase;">{{ $appointment->status }}</span></td>
                                <td><span class="ellipse align-middle">{{ $appointment->doctor->name }}</span></td>
                                <td style="max-width: 100px; word-wrap: break-word; white-space: normal;">
                                    @foreach ($appointment->appointmentServices as $as)
                                        <span class="badge badge-info">{{ $as->service->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm editAppntBtn" data-id="{{ $appointment->id }}" data-toggle="modal" data-target="#editAppntModal">Edit</button>
                                    <button class="btn btn-danger btn-sm deleteAppntBtn" data-id="{{ $appointment->id }}">Delete</button>
                                </td>   
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- End of All Other Appnts -->
</div>

