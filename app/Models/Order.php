<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'payment_method',
        'payment_status',
        'payment_details',
        'order_date',
        'delivery_date',
        'cencelled_date',
        'logistics_type',
        'tracking_code',
        'product_id',
        'sub_total',
        'total_amount',
        'coupon',
        'delivery_charge',
        'delivery_time',
        'quantity',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'address',
        'city',
        'state',
        'note',
    ];
   
    public function products() {
        return $this->belongsToMany(Product::class, 'order_details')->withPivot('quantity');
    }
}
