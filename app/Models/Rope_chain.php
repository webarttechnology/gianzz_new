<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rope_chain extends Model
{
    use HasFactory;
    protected $fillable = ['name','blog_id','gold_color','amount','is_active','discount_percentage','final_price','discount_amt','carat', 'image'];

    public function blog(){
    	return $this->hasMany(Blog::class);
    }
    
}
