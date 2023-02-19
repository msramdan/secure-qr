<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeQrcode extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y');
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y');
    }
}
