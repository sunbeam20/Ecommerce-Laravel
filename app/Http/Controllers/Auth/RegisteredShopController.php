<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredShopController extends Controller
{
    //
    public function register(Request $request)
    {
        $user = new Shop();

        $user->user_name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->address = $request->address ;
        $user->city = $request->city ;
        $user->state = $request->state ;
        $user->zip = $request->zip ;
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $user->save();
        if (Auth::guard('seller')->attempt($credentials)) {
            $sellerId = Auth::guard('seller')->user()->id;
            $orders = Order::join('products', 'orders.product_id', '=', 'products.id')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->where('products.shop_id', $sellerId)
                ->select(
                    'orders.*',
                    'users.name as user_name',
                    'users.email as user_email',
                    'users.address as user_address',
                    'users.city as user_city',
                    'users.state as user_state',
                    'users.zip as user_zip',
                    'products.name as product_name',
                    'products.slug as product_slug',
                    'products.image as product_image',
                    'products.description as product_description',
                    'products.stock as product_stock',
                    'products.brand as product_brand',
                    'products.price as product_price'
                )
                ->get();

            $topSold = Product::leftJoin('orders', 'products.id', '=', 'orders.product_id')
                ->select('products.*', DB::raw('SUM(orders.product_quantity) as total_quantity_sold'))
                ->where('products.shop_id', $sellerId)
                ->groupBy('products.id', 'products.shop_id', 'products.category_id', 'products.name', 'products.slug', 'products.image', 'products.description', 'products.stock', 'products.brand', 'products.price', 'products.created_at', 'products.updated_at')
                ->orderByDesc('total_quantity_sold')
                ->get();

            $products = Product::where('shop_id', $sellerId)->get();
            return view('sellerHome', ['orders' => $orders, 'products' => $products, 'topSold' => $topSold]);
        }
        return back();
        
    }
}
