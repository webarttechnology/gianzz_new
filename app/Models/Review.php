<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['blog_id','registration_id','review','point'];

    public function blog(){
    	return $this->belongsTo(Blog::class);
    }

    public function registration(){
    	return $this->belongsTo(Registration::class);
    }
}
