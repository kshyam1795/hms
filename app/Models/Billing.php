<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    protected $fillable = [
        'uniquePatientID',
        'patient_id',
        'total_amount',
        'paid_amount',
        'balance_amount',
        	
    ];

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'uniquePatientID', 'uniquePatientID');
    }
    
}
