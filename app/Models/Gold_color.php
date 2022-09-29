<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gold_color extends Model
{
    use HasFactory;
    protected $fillable = ['color','is_active'];
}
