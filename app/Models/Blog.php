<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['name','tittle','description','is_variation','p_amt','image','is_active','categary_id','subcategary_id','image4','name','slug_name','sku_code','gold_color','discount_percentage','discount_amt','carat'];
    
    public function categary(){
    	return $this->belongsTo(Categary::class);
    }

    public function subcategary(){
    	return $this->belongsTo(Subcategary::class);
    }

    public function ropeChain(){
    	return $this->belongsTo(Rope_chain::class);
    }

    public function order(){
    	return $this->hasMany(Order::class);
    }


    public function wishlist(){
    	return $this->hasMany(Wishlist::class);
    }

    public function rope_chain(){
    	return $this->belongsTo(Rope_chain::class);
    }

    public function review(){
    	return $this->hasMany(Review::class);
    }
}
