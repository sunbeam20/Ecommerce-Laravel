<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'user_id', 'product_price', 'product_quantity', 'status', 'payment_method', 'delivery_method'];

    // Generate slug automatically
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {

        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
