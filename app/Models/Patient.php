<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'uniquePatientID',
        'honorific',
        'name',
        'email',
        'phone',
        'address',
        'age',
        'dob',
        'gender',
        'city', 
        'pincode', 
        'existingBidStr',
        'blood_group', 
        'preferred_language',
        'careOf',
        'SecondaryPhone', 
        'occupation',
        'tag',
        'user_id',
    ];
    
    public function appointments()
    {
        //return $this->hasMany(Appointment::class);
        return $this->hasMany(Appointment::class, 'patient_id', 'id');
    }
    
    public function billings()
    {
        return $this->hasMany(Billing::class);
    }
    public function doctors()
    {
        return $this->hasManyThrough(
            Doctor::class,
            Appointment::class,
            'id', // local key on the doctors table
            'id', // Local key on the patients table
            'doctor_id', // Foreign key on the appointments table
            'patient_id' // Foreign key on the appointments table
        );
    }
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
