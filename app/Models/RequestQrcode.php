<?php

namespace App\Models;

use App\Models\Partner;
use App\Models\Product;
use App\Models\TypeQrcode;
use App\Models\HistoryRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestQrcode extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function type_qrcode()
    {
        return $this->belongsTo(TypeQrcode::class);
    }

    public function histories()
    {
        return $this->hasMany(HistoryRequest::class, 'request_qrcode_id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'user_id');
    }
}
