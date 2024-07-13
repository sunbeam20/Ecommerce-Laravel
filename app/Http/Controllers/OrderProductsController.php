<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_Products;
class OrderProductsController extends Controller
{
    public function create()
    {
        // Logic to display a form for creating a new order product
    }

    public function store(Request $request)
    {
        // Logic to store a new order product based on the data submitted through $request
        $validatedData = $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'product_price' => 'required',
            'product_quantity' => 'required',
        ]);

        $orderProduct = Order_Products::create($validatedData);

        // Additional logic or redirect to appropriate page
    }

    public function edit($id)
    {
        // Logic to display a form for editing an existing order product based on the provided $id
        $orderProduct = Order_Products::findOrFail($id);

        // Additional logic or view
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing order product based on the data submitted through $request and the provided $id
        $orderProduct = Order_Products::findOrFail($id);

        $validatedData = $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'product_price' => 'required',
            'product_quantity' => 'required',
        ]);

        $orderProduct->update($validatedData);

        // Additional logic or redirect to appropriate page
    }

    public function destroy($id)
    {
        // Logic to delete an existing order product based on the provided $id
        $orderProduct = Order_Products::findOrFail($id);
        $orderProduct->delete();

        // Additional logic or redirect to appropriate page
    }//
}
