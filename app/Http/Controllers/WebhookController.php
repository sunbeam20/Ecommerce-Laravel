<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Get the Dialogflow request data
        $data = $request->json()->all();
        $queryResult = $data['queryResult'];

        // Process the query result
        $intent = $queryResult['intent']['displayName'];
        $parameters = $queryResult['parameters'];

        // Perform the necessary logic based on the intent and parameters
        $response = $this->handleIntent($intent, $parameters);

        // Return the response to Dialogflow
        return response()->json($response);
    }

    private function handleIntent($intent, $parameters)
    {
        if ($intent === 'FindProduct') {
            $productName = isset($parameters['ProductNameEntities']) ? $parameters['ProductNameEntities'] : null;
            $categoryName = isset($parameters['category']) ? $parameters['category'] : null;
            $price = isset($parameters['unit-currency']['amount']) ? $parameters['unit-currency']['amount'] : null;

            // Prepare the query to search for products
            $query = Product::query();

            // Filter based on product name
            if ($productName) {
                $query->where('name', 'like', '%' . $productName . '%');
            }

            // Filter based on category
            if ($categoryName) {
                $category = Category::where('name', $categoryName)->first();
                if ($category) {
                    $query->where('category_id', $category->id);
                }
            }

            // Filter based on price
            if ($price) {
                $query->where('price', '<=', $price);
            }

            // Perform the search and retrieve the products
           $products = $query->take(5)->get();

            if ($products->isEmpty()) {
                // If no products match the search criteria, provide an appropriate response
                $response = [
                    'fulfillmentText' => 'Sorry, I could not find any products matching your criteria.',
                ];
            } else {
                // Construct the response with product information
                $responseText = 'Here are some products that match your search:';
                
                $richResponses = [];
                
                foreach ($products as $product) {
                    $richResponses[] = [
                        'type' => 'info',
                        'title' => $product->name,
                        'subtitle' => "Category: " . $product->category->name . "\nPrice: RM" . $product->price . "\nStock: " . $product->stock,
                        'image' => [
                            'type' => 'image',
                            'rawUrl' => 'https://refined-nominally-molly.ngrok-free.app/'.$product->image,
                            'accessibilityText' => $product->name,
                        ],
                        'actionLink' => '/Product'.'/'. $product->id, // Replace with the appropriate action link for the product
                    ];
                }
                
                $response = [
                    'fulfillmentMessages' => [
                        [
                            'payload' => [
                                'richContent' => [$richResponses],
                            ],
                        ],
                    ],
                ];
                
            }
        } else {
            // If the intent is not recognized, provide a generic response
            $response = [
                'fulfillmentText' => "Sorry, I'm not sure what you're asking. Can you please rephrase your query?",
            ];
        }

        return $response;
    }
}
// $response = [
//     'fulfillmentText' => $parameters,
// ];