<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'slug', 
        'photo', 
        'status',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }
}
