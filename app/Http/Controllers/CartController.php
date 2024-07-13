<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
class CartController extends Controller
{
    public function index()
    {
        // Logic to fetch and display a list of carts
        $carts = Cart::all();
        return  $carts;
        // Additional logic or view
    }
    public function addCart(Request $request)
    {
        if (auth()->guest()) {
            return redirect()->back()->with('message', 'Please log in to add the product to your cart.');
        }
        
        $productData = $request->input('product');
        $product = json_decode($productData, true);
        
        $user_id = $request->user_id;
        $product_id = $product['id'];
        
        // Check if the product is already in the cart for the current user
        $existingCartItem = Cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();
        
        if ($existingCartItem) {
            // If the product is already in the cart, increment the quantity by one
            $existingCartItem->increment('product_quantity');
        } else {
            // If the product is not in the cart, create a new cart item
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->product_id = $product_id;
            $cart->product_price = $product['price'];
            $cart->product_quantity = 1;
            $cart->save();
        }
        
        return back();
        
    }
    public function show(Request $request)
    {
        $userid = $request->user_id;
        // Logic to fetch and display a single cart based on the provided $id
        $carts = Cart::with('product')->where('user_id', $userid)->get();

        //return $carts;
        return view('CartPage', ['carts' => $carts]);
        // Additional logic or view
    }

    public function create()
    {
        // Logic to display a form for creating a new cart
    }

    public function store(Request $request)
    {
        // Logic to store a new cart based on the data submitted through $request
        $validatedData = $request->validate([
            'user_id' => 'required',
        ]);

        $cart = Cart::create($validatedData);

        // Additional logic or redirect to appropriate page
    }

    public function edit($id)
    {
        // Logic to display a form for editing an existing cart based on the provided $id
        $cart = Cart::findOrFail($id);

        // Additional logic or view
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing cart based on the data submitted through $request and the provided $id
        $cart = Cart::findOrFail($id);

        $validatedData = $request->validate([
            'user_id' => 'required',
        ]);

        $cart->update($validatedData);

        // Additional logic or redirect to appropriate page
    }

    public function destroy($id)
    {
        // Logic to delete an existing cart based on the provided $id
        $cart = Cart::findOrFail($id);
        $cart->delete();

        // Additional logic or redirect to appropriate page
    }//
}
