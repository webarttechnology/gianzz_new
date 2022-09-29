<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['registration_id','total_amt','order_no','pay_amt','payment_status','invoice_no','save_amt', 'spl_discount'];

    public function order(){
    	return $this->hasMany(Order::class);
    }

    public function registration(){
    	return $this->belongsTo(Registration::class);
    }
}
