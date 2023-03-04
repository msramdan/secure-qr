<?php

namespace App\Models;

use App\Models\QrCode;
use App\Traits\HasCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductScanned extends Model
{
    use HasFactory, HasCode;
    protected $guarded = ['id'];
    public function qr_code()
    {
        return $this->belongsTo(QrCode::class);
    }
}
