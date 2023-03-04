<?php

namespace App\Models;

use App\Models\RequestQrcode;
use App\Traits\HasCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QrCode extends Model
{
    use HasFactory, HasCode;
    protected $guarded = ['id'];

    public function request_qrcode()
    {
        return $this->belongsTo(RequestQrcode::class);
    }
}
