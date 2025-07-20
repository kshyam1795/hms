<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming conventions


    // Define the fillable attributes
    protected $fillable = [
        'billing_id',
        'amount',
        'mode',
        
    ];

    /**
     * Define the relationship with the Bill model.
     * A deposit belongs to a bill.
     */
    public function bill()
    {
        return $this->belongsTo(Billing::class);
    }
}
