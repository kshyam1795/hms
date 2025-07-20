<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'gst',
        'priority',
        'service_owner',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}

