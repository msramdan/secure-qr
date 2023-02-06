<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Partner;
use App\Models\Business;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d F Y');
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d F Y');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
