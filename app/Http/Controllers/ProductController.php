<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Order;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        // Retrieve the search query
        $query = $request->input('query');
        // Retrieve the filter parameters
        $category = $request->input('category');
        $brand = $request->input('brand');
        $queryBuilder = DB::table('products');


        if ($query) {
            $categoryIds = DB::table('products')
                ->select('category_id')
                ->where('name', 'LIKE', '%' . $query . '%')
                ->pluck('category_id')
                ->toArray();

            $queryBuilder
                ->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere(function ($query) use ($categoryIds) {
                    $query->whereIn('category_id', $categoryIds);
                })
                ->orderByRaw("CASE WHEN name LIKE '%$query%' THEN 0 ELSE 1 END");
        }
        if ($category) {
            $queryBuilder->where('category_id', $category);
        }
        if ($brand) {
            if ($brand === 'brand') {
                $queryBuilder->whereNotNull('brand');
            } else if ($brand === 'non_brand') {
                $queryBuilder->whereNull('brand');
            }
        }


        $products = $queryBuilder->get();
        // Display 10 products per page http://127.0.0.1:8000/search?query=Shoes&category=5

        //return $products;
        return view('results', ['product' => $products, 'query' => $query, 'cat' => $category]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'variants' => 'required|array',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.attributes' => 'required|array',
            'variants.*.attributes.*' => 'required|exists:attributes,id',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        foreach ($request->variants as $variantData) {
            $variant = Variant::create([
                'product_id' => $product->id,
                'stock' => $variantData['stock'],
            ]);

            $variant->attributes()->attach($variantData['attributes']);
        }

        return response()->json(['message' => 'Product created successfully'], 201);
    }

    public function addProduct(Request $request)
    {
        $product = new Product();

        $product->name = $request->name;
        //dd($request->hasFile('images'));
        if ($request->hasFile('images')) {
            $productImage = $request->file('images');
            $imagePath = $productImage->storeAs('images/products', $productImage->getClientOriginalName(), 'public');
            $product->image = $imagePath;
            // return $product;
        } else {
            return 'No Image';
        }

        $product->brand = $request->brand;
        $product->stock = $request->quantity;
        $product->category_id = $request->input('mySelect');
        $product->price = $request->price;
        $product->description = $request->description;
        $product->shop_id = Auth::guard('seller')->user()->id;
        $product->save();
        return redirect('/SellerHome')->with('message', 'Success!');
    }
    // Get all products with variants and attributes
    public function index()
    {
        $userId = Auth::id();
        $recommend = Cart::with('product')->where('user_id', $userId)->limit(6)->get();
        if ($recommend->count() < 18) {
            $orders = Order::with('product')
                ->where('user_id', $userId)
                ->limit(6)
                ->get();
            $recommend = $recommend->merge($orders);
        }
        View::share('recommend', $recommend);
        return redirect('/SellerHome')->with('message', 'Success!');
    }

    // Get One Product details by ID
    public function show($id)
    {
        $product = Product::leftJoin('orders', 'products.id', '=', 'orders.product_id')
            ->leftJoin('shops', 'products.shop_id', '=', 'shops.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.id',
                'products.shop_id',
                'shops.name as shop_name',
                'products.category_id',
                'categories.name as category_name', // Select the category name
                'products.name',
                'products.slug',
                'products.image',
                'products.description',
                'products.stock',
                'products.brand',
                'products.price',
                'products.created_at',
                'products.updated_at',
                DB::raw('SUM(orders.product_quantity) as total_quantity_sold')
            )
            ->with('variants.attributes')
            ->where('products.id', $id)
            ->groupBy(
                'products.id',
                'products.shop_id',
                'shops.name',
                'products.category_id',
                'categories.name', // Group by the category name
                'products.name',
                'products.slug',
                'products.image',
                'products.description',
                'products.stock',
                'products.brand',
                'products.price',
                'products.created_at',
                'products.updated_at'
            )
            ->firstOrFail();



        $categoryId = $product['category_id'];
        $relatedProducts = Product::leftJoin('orders', 'products.id', '=', 'orders.product_id')
            ->where('category_id', $categoryId)
            ->select('products.*', DB::raw('SUM(orders.product_quantity) as total_quantity_sold'))
            ->groupBy('products.id', 'products.shop_id', 'products.category_id', 'products.name', 'products.slug', 'products.image', 'products.description', 'products.stock', 'products.brand', 'products.price', 'products.created_at', 'products.updated_at')
            ->limit(8)
            ->get();


        //return $relatedProducts;
        return view('product', ['product' => $product, 'relatedProducts' => $relatedProducts]);
    }

    public function update(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string',
        //     'description' => 'required|string',
        //     'price' => 'required|numeric',
        // ]);

        $product = Product::findOrFail($request->id);
        if ($request->hasFile('images')) {

            $productImage = $request->file('images');
            $imagePath = $productImage->store('images/products', 'public');
            //       
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $imagePath,
                'brand' => $request->brand,
                'stock' => $request->quantity,
                'category_id' => $request->input('mySelect')
            ]);
            return $product;
        } else {
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'brand' => $request->brand,
                'stock' => $request->quantity,
                'category_id' => $request->input('mySelect')
            ]);
        }


        // return response()->json(['message' => 'Product updated successfully']);

        return redirect('/SellerHome')->with('message', 'Success!');
    }
    public function destroy($id)
    {
        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Delete the product from the database
        $product->delete();

        // You can also add additional logic or success messages if needed

        // Redirect back to the products listing page or any other page you want
        return redirect('/SellerHome')->with('message', 'Delete Success!');
    }
}
