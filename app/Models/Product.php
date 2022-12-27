<?php

namespace App\Models;

use App\Models\Business;
use App\Models\Category;
use App\Models\UserPartner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function categroy()
    {
        return $this->belongsTo(Category::class);
    }
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
    public function partner()
    {
        return $this->belongsTo(UserPartner::class);
    }
}
