@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Add Appointment</h4>
    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="doctor_id">Doctor</label>
            <select name="doctor_id" id="doctor_id" class="form-control" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="patient_id">Patient</label>
            <select name="patient_id" id="patient_id" class="form-control" required>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="time_slot">Time Slot</label>
            <select name="appointment_date" id="time_slot" class="form-control" required>
                <!-- Time slots will be populated here dynamically -->
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#doctor_id, #date').change(function() {
            fetchTimeSlots();
        });

        function fetchTimeSlots() {
            const doctorId = $('#doctor_id').val();
            const date = $('#date').val();

            if (doctorId && date) {
                $.ajax({
                    url: `/appointments/time-slots`,
                    type: 'GET',
                    data: {
                        doctor_id: doctorId,
                        date: date
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        const timeSlotSelect = $('#time_slot');
                        timeSlotSelect.empty();

                        data.forEach(timeSlot => {
                            const option = $('<option></option>').val(timeSlot).text(new Date(timeSlot).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }));
                            timeSlotSelect.append(option);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('There was a problem with the AJAX operation:', error);
                    }
                });
            }
        }
    });
</script>
@endsection
