<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // Get the productIds array from the request
        $productIds = $request->get('productId');

        // Use the 'whereIn' method to retrieve products with the given IDs
        $items = Product::whereIn('id', $productIds)->get();

        // Now you have the products corresponding to the productIds array
        // You can do whatever you want with the $products here

        // For example, you can return the products to a view
        return view('checkout', compact('items'));
    }
    public function checkoutOne($id)
    {
        // Retrieve the product with the given ID
        $items = Product::findOrFail($id);
        //return $products;
        return view('checkout', ['items' => [$items]]);
        // Now you have the product corresponding to the product ID
        // You can do whatever you want with the $product here

        // For example, you can return the product to a view
        //return view('checkout', compact('product'));
    }



    public function index()
    {
        // Logic to fetch and display a list of orders
        $orders = Order::all();

        // Additional logic or view
    }

    public function show($id)
    {
        // Logic to fetch and display a single user's order based on the provided $id
        $orders = Order::join('products', 'orders.product_id', '=', 'products.id')
            ->where('user_id', $id)
            ->get();
        return view('myOrders', ['orders' => $orders]);
        //return $order;
        // Additional logic or view
    }
    public function showOrders(Request $request)
    {
        // Logic to fetch and display a single order based on the provided $id
        // $sellerId = $request->seller_id;
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
        // return $topSold;// Additional logic or view
    }

    public function create(Request $request)
    {
        if (auth()->guest()) {
            return redirect()->back()->with('message', 'Please log in to Checkout product.');
        }
        // Decode the JSON string into an array of objects
        // Decode the JSON string into an array of objects
        $productsData = json_decode($request->input('products'));

        // Loop through the products and create orders
        foreach ($productsData as $productData) {
            $order = new Order();
            $order->user_id = $request->user_id;
            $order->product_id = $productData->id; // Use the product's id from the decoded data
            $order->product_price = $productData->price; // Use the product's price from the decoded data
            $order->product_quantity = 1; // You may adjust this based on your requirement, or use a form input to get the quantity
            $order->status = 'to_ship';
            $order->payment_method = $request->input('payment');
            $order->delivery_method = $request->input('collection');
            $order->save();
        }
        //return $order;
        // $order->save();
        return redirect('/')->with('message', 'Order Placed Success!');
        // Logic to display a form for creating a new order
    }

    public function store(Request $request)
    {
        // Logic to store a new order based on the data submitted through $request
        $validatedData = $request->validate([
            'status' => 'required',
            'payment_method' => 'required',
            'user_id' => 'required',
        ]);

        $order = Order::create($validatedData);

        // Additional logic or redirect to appropriate page
    }

    public function edit($id)
    {
        // Logic to display a form for editing an existing order based on the provided $id
        $order = Order::findOrFail($id);

        // Additional logic or view
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing order based on the data submitted through $request and the provided $id
        $order = Order::findOrFail($id);

        $validatedData = $request->validate([
            'status' => 'required',
            'payment_method' => 'required',
            'user_id' => 'required',
        ]);

        $order->update($validatedData);

        // Additional logic or redirect to appropriate page
    }

    public function destroy($id)
    {
        // Logic to delete an existing order based on the provided $id
        $order = Order::findOrFail($id);
        $order->delete();

        // Additional logic or redirect to appropriate page
    } //
    public function cancelOrder($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Perform the necessary actions for canceling the order
        $order->status = 'cancel';
        $order->save();

        return redirect()->back()->with('success', 'Order canceled successfully.');
    }

    public function received($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Perform the necessary actions for marking the order as received
        $order->status = 'completed';
        $order->save();

        return redirect()->back()->with('success', 'Order marked as received.');
    }

    public function returnOrder($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Perform the necessary actions for returning the order
        $order->status = 'pending_refund';
        $order->save();

        return redirect()->back()->with('success', 'Order returned for refund.');
    }

    public function approveRefund($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Perform the necessary actions for approving the refund
        $order->status = 'refunded';
        $order->save();

        return redirect()->back()->with('success', 'Refund approved successfully.');
    }
    public function productShipped($id)
    {
        // Find the product with the given ID
        $product = Order::findOrFail($id);

        // Update the status of the product to "shipped"
        $product->status = 'to_recieve';
        $product->save();

        // Redirect back to the previous page or any other desired route
        return redirect('/SellerHome')->with('message', 'Product shipped successfully.');
    }
    public function productRefund(Request $request, $id)
    {
        // Retrieve the product with the given ID
        $product = Order::findOrFail($id);

        // Get the selected action from the form
        $selectedAction = $request->input('mySelect');

        // Update the product's status based on the selected action
        if ($selectedAction === 'refund') {
            // Perform actions for "Approve" (refund) status
            $product->status = 'refund';
            // Add any other actions you want to perform for this status

        } elseif ($selectedAction === 'completed') {
            // Perform actions for "Cancel" status
            $product->status = 'completed';
            // Add any other actions you want to perform for this status
        }

        // Save the updated product
        $product->save();

        // Redirect back to the page where the form was submitted from
        return redirect('/SellerHome')->with('success', 'Product status updated successfully.');
    }
}
