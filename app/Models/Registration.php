<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = ['name','email_id','password','verification_code','is_active','mobile_no','city','state','pincode','image'];

    public function order(){
    	return $this->hasMany(Invoice::class);
    }

    public function invoice(){
    	return $this->hasMany(Order::class);
    }

    public function review(){
    	return $this->hasMany(Review::class);
    }
}
