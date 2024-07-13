<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart_Products;

class CartProductsController extends Controller
{
    public function store(Request $request)
    {
        // Logic to store a new cart product based on the data submitted through $request
        $validatedData = $request->validate([
            'cart_id' => 'required',
            'product_id' => 'required',
            'product_price' => 'required',
            'product_quantity' => 'required',
        ]);

        $cartProduct = Cart_Products::create($validatedData);

        // Additional logic or redirect to appropriate page
    }

    public function edit($id)
    {
        // Logic to display a form for editing an existing cart product based on the provided $id
        $cartProduct = Cart_Products::findOrFail($id);

        // Additional logic or view
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing cart product based on the data submitted through $request and the provided $id
        $cartProduct = Cart_Products::findOrFail($id);

        $validatedData = $request->validate([
            'cart_id' => 'required',
            'product_id' => 'required',
            'product_price' => 'required',
            'product_quantity' => 'required',
        ]);

        $cartProduct->update($validatedData);

        // Additional logic or redirect to appropriate page
    }

    public function destroy($id)
    {
        // Logic to delete an existing cart product based on the provided $id
        $cartProduct = Cart_Products::findOrFail($id);
        $cartProduct->delete();

        // Additional logic or redirect to appropriate page
    }
    //
}
