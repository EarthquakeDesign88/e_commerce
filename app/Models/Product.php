<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'additional_info',
        'return_cancellation',
        'stock',
        'brand_id',
        'category_id',
        'child_cat_id',
        'photo',
        'price',
        'offer_price',
        'discount',
        'size',
        'size_guide',
        'conditions',
        'status',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public static function getProductByCart($id) {
        return self::where('id', $id)->get()->toArray();
    }

    public static function getProductByWishlist($id) {
        return self::where('id', $id)->get()->toArray();
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_items')->withPivot('quantity');
    }

}
