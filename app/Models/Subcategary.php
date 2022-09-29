<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categary;
use App\Models\Blog;

class Subcategary extends Model
{
    use HasFactory;
    protected $fillable = ['categary_id', 'name', 'is_active','slug_subcategory'];

    public function categary(){
    	return $this->belongsTo(Categary::class);
    }

    public function blog(){
    	return $this->hasMany(Blog::class);
    }
}
