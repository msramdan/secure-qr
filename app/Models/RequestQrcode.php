<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Partner;
use App\Models\Product;
use App\Models\TypeQrcode;
use App\Models\HistoryRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestQrcode extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function getAmountPriceAttribute($value)
    {
        return 'Rp. ' . number_format($value, 2, ',', '.');
    }
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
    // casting
    protected function tanggalRequest(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d F Y'),
        );
    }
    protected function tglUploadBuktiBayar(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d F Y'),
        );
    }
}
