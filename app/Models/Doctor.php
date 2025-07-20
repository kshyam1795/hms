<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'specialization',
        'user_id',
        
        
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function patients()
    {
        return $this->hasManyThrough(
            Patient::class,
            Appointment::class,
            'doctor_id', // Foreign key on the appointments table
            'id', // Foreign key on the patients table
            'id', // Local key on the doctors table
            'patient_id' // Local key on the appointments table
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class);  // Assuming the 'user_id' is the foreign key
    }
}
