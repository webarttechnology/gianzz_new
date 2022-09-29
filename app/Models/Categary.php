<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategary;
use App\Models\Blog;

class Categary extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'is_active','is_deleted','slug_categary','image'];

    public function subcategary(){
    	return $this->hasMany(Subcategary::class);
    }

    public function blog(){
    	return $this->hasMany(Blog::class);
    }
}
