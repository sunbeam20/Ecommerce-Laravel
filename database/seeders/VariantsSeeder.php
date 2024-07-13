<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Variant;
use App\Models\Attribute;
use Illuminate\Database\Seeder;

class VariantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        $colors = ['Yellow', 'Blue', 'Red'];
        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];

        $variantsData = [];

        foreach ($colors as $color) {
            foreach ($sizes as $size) {
                $variantsData[] = [
                    'stock' => rand(1, 10),
                    'attributes' => [
                        'Size' => $size,
                        'Color' => $color,
                    ],
                ];
            }
        }


        foreach ($products as $product) {
            $variantsCount = random_int(1, count($variantsData));

            $variants = collect($variantsData)
                ->random($variantsCount)
                ->map(function ($variantData) use ($product) {
                    $variant = Variant::create([
                        'product_id' => $product->id,
                        'stock' => $variantData['stock'],
                    ]);

                    foreach ($variantData['attributes'] as $attributeName => $attributeValue) {
                        $attribute = Attribute::firstOrCreate(['name' => $attributeName]);

                        $variant->attributes()->attach($attribute->id, ['value' => $attributeValue]);
                    }

                    return $variant;
                });

            $product->variants()->saveMany($variants);
        }
    }
}
