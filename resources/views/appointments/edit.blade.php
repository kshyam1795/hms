@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Appointment</h4>
    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="doctor_id">Doctor</label>
            <select name="doctor_id" id="doctor_id" class="form-control" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="patient_id">Patient</label>
            <select name="patient_id" id="patient_id" class="form-control" required>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
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
            <input type="text" name="status" class="form-control" value="{{ $appointment->status }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    document.getElementById('doctor_id').addEventListener('change', fetchTimeSlots);
    document.getElementById('date').addEventListener('change', fetchTimeSlots);

    function fetchTimeSlots() {
        const doctorId = document.getElementById('doctor_id').value;
        const date = document.getElementById('date').value;

        if (doctorId && date) {
            fetch(`/appointments/time-slots?doctor_id=${doctorId}&date=${date}`)
                .then(response => response.json())
                .then(data => {
                    const timeSlotSelect = document.getElementById('time_slot');
                    timeSlotSelect.innerHTML = '';

                    data.forEach(timeSlot => {
                        const option = document.createElement('option');
                        option.value = timeSlot;
                        option.textContent = new Date(timeSlot).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        timeSlotSelect.appendChild(option);
                    });
                });
        }
    }
</script>
@endsection

