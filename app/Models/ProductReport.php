<?php

namespace App\Models;

use App\Traits\HasCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReport extends Model
{
    use HasFactory, HasCode;
    protected $guarded = ['id'];
}
