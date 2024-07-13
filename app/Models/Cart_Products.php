<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_Products extends Model
{
    use HasFactory;
    protected $fillable = ['cart_id', 'product_id', 'product_price', 'product_quantity'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cart_product) {

        });
    }
    public function cart() {
        return $this->belongsTo(Cart::class);
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
