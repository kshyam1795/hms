<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRCodeModel extends Model
{
    use HasFactory;
    protected $table = 'qr_codes';
    protected $fillable = ['title', 'code', 'url', 'qr_code_path'];

    public function scans()
    {
        return $this->hasMany(QRScan::class, 'qr_code_id', 'id');
    }
}
