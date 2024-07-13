<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/webhook', [WebhookController::class, 'handle']);

Route::get('/home', function(){
    return view("home");
});

// Route::get('/{view}', [ProductController::class, 'index']);
Route::get('/Login', function () {
    return view("login");
});
Route::get('/Signup', function () {
    return view("signup");
});

Route::get('/products', [ProductController::class, 'index']); //show all product
Route::get('/Product/{id}', [ProductController::class, 'show'])->where('id', '[0-9]+'); //show one prodct details

Route::get('/search', [ProductController::class, 'search']);
Route::get('/Results', function () {
    return view("results");
});

Route::post('cart', [CartController::class, 'addCart']); //add product to cart
Route::post('/CartPage', [CartController::class, 'show']); //view cart with user id {post}

Route::get('Product/Checkout/{id}', [OrderController::class, 'checkoutOne']); //show one prodct checkout
Route::get('checkout', [OrderController::class, 'checkout']);
Route::post('neworder', [OrderController::class, 'create']);


Route::get('/customerProfile', function () {
    return view("customerProfile");
});
Route::put('/update-profile', [UserController::class, 'updateProfile']);
Route::put('/update-address', [UserController::class, 'updateAddress']);

// routes/web.php
Route::put('/cancelOrder/{id}', [OrderController::class, 'cancelOrder']);
Route::put('/recieved/{id}', [OrderController::class, 'received']);
Route::put('/return/{id}', [OrderController::class, 'returnOrder']);
Route::put('/approveRefund/{id}', [OrderController::class, 'approveRefund']);


Route::get('/MyOrders/{id}', [OrderController::class, 'show']);

Route::get('/SellerLogin', function () {
    return view("sellerLogin");
});
Route::get('/SellerSignup', function () {
    return view("sellerSignup");
});

Route::get('/SellerHome', [OrderController::class, 'showOrders']);
// Define the route to handle product shipment
Route::put('/productShipped/{id}', [OrderController::class, 'productShipped']);
Route::put('/productRefund/{id}', [OrderController::class, 'productRefund']);
Route::delete('/deleteProduct/{id}', [ProductController::class, 'destroy']);


Route::post('/products', [ProductController::class, 'addProduct']);
Route::put('/products', [ProductController::class, 'update']);

Route::put('/seller-update-profile', [ShopController::class, 'updateName']);
Route::put('/seller-update-email', [ShopController::class, 'updateEmail']);


require __DIR__ . '/auth.php';
