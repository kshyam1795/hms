<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'uniquePatientID',
        'doctor_id',
        'patient_id',
        'appointment_date',
        'appointment_time',
        'service_id',
        'duration',
        'status',
        'payment_completed',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function billing()
    {
        return $this->hasOne(Billing::class, 'uniquePatientID'); // Assuming `appointment_id` is the foreign key
    }
    public function receptionist()
    {
        return $this->belongsTo(User::class, 'receptionist_id');
    }
    public function appointmentServices()
    {
        return $this->hasMany(AppointmentService::class);
    }
}
