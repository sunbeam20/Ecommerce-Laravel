<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Products extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'product_id', 'product_price', 'product_quantity'];

    // Generate slug automatically
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order_products) {
            
        });
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
