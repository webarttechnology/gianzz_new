<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name','logo','email','mobile_no','image','address', 'is_active','is_deleted','facebook_link','twitter_link','tittle','details','ourmission_details'];
}
