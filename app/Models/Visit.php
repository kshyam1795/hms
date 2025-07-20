<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $dates = ['created_at'];
    protected $fillable = ['patient_id', 'complaints', 'diagnosis','tests', 'advice', 'doctor_id', 'next_visit'];

    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
