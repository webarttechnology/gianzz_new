<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id','blog_id','registration_id','email_id','fname','company','address','address1','city','country','state','pincode','amount','final_price','discount_percentage','discount_amt','mobile_no','quantatity','color','size'];

    public function invoice(){
    	return $this->belongsTo(Invoice::class);
    }

    public function blog(){
    	return $this->belongsTo(Blog::class);
    }

    public function registration(){
    	return $this->belongsTo(Registration::class);
    }


}
