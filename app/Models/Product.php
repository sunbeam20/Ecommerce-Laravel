<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'price', 'images', 'shop_id', 'stock'];

    // Generate slug automatically
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);

            $latestSlug =
                static::whereRaw("(slug = '$product->slug' OR slug LIKE '$product->slug-%')")
                ->latest('id')
                ->value('slug');

            if ($latestSlug) {
                $pieces = explode('-', $latestSlug);

                $number = intval(end($pieces));

                $product->slug .= '-' . ($number + 1);
            }
        });
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function thumbnail()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'thumbnail');
    }

    public function gallery()
    {
        return $this->morphMany(Image::class, 'imageable')->where('type', 'gallery');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }
}
