<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $topSold = Product::leftJoin('orders', 'products.id', '=', 'orders.product_id')
            ->select('products.*', DB::raw('SUM(orders.product_quantity) as total_quantity_sold'))
            ->groupBy('products.id', 'products.shop_id', 'products.category_id', 'products.name', 'products.slug', 'products.image', 'products.description', 'products.stock', 'products.brand', 'products.price', 'products.created_at', 'products.updated_at')
            ->orderByDesc('total_quantity_sold')
            ->paginate(18);

        $products = Product::leftJoin('orders', 'products.id', '=', 'orders.product_id')
            ->select('products.*', DB::raw('SUM(orders.product_quantity) as total_quantity_sold'))
            ->groupBy('products.id', 'products.shop_id', 'products.category_id', 'products.name', 'products.slug', 'products.image', 'products.description', 'products.stock', 'products.brand', 'products.price', 'products.created_at', 'products.updated_at')
            ->get();

        $categories =  Category::all();
        $carts = Cart::all();
        View::share('products', $products); //
        View::share('categories', $categories);
        View::share('carts', $carts);
        View::share('topSold', $topSold);
    }
}
