<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'images' => 'electronics.png',
                'description' => 'Explore a wide range of electronic products.',
            ],
            [
                'name' => 'Clothing',
                'slug' => 'clothing',
                'images' => 'clothing.png',
                'description' => 'Shop for fashionable clothing and accessories.',
            ],
            [
                'name' => 'Home & Kitchen',
                'slug' => 'home-kitchen',
                'images' => 'home&kitchen.png',
                'description' => 'Discover products for your home and kitchen needs.',
            ],
            [
                'name' => 'Books',
                'slug' => 'books',
                'images' => 'books.png',
                'description' => 'Find a collection of books from various genres.',
            ],
            [
                'name' => 'Sports & Fitness',
                'slug' => 'sports-fitness',
                'images' => 'sports&fitness.png',
                'description' => 'Get fit with sports and fitness equipment.',
            ],
        ];

        foreach ($categories as $category) {
            $category['images'] = '/images/categories/' . $category['images'];
            Category::create($category);
        }
    }
}
