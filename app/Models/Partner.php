<?php

namespace App\Models;

use App\Models\Business;
use App\Traits\HasCode;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Partner extends Model
{
    use HasFactory, HasCode, Notifiable;
    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token', 'id'];
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function business()
    {
        return $this->hasMany(Business::class);
    }
}
