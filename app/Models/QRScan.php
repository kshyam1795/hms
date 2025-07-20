<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRScan extends Model
{
    use HasFactory;

    protected $table = 'qr_scans';

    protected $fillable = ['qr_code_id', 'device', 'browser', 'os', 'ip_address', 'latitude', 'longitude'];

    public function qrCode()
    {
        return $this->belongsTo(QrCodeModel::class, 'qr_code_id', 'id'); // Ensure correct column name
    }
}
