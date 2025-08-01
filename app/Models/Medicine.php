<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable = ['visit_id', 'name', 'dosage', 'when', 'where', 'frequency', 'duration', 'notes'];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}
