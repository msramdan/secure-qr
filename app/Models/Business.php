<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\HasCode;
use App\Models\BusinessVideo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{
    use HasFactory, HasCode;
    protected $guarded = ['id'];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d F Y');
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d F Y');
    }
    public function business_video()
    {
        return $this->hasOne(BusinessVideo::class);
    }
}
