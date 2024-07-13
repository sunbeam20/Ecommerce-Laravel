<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $numberOfUsers = 10; // Specify the number of users to create

        for ($i = 1; $i <= $numberOfUsers; $i++) {
            User::create([
                'email' => 'test' . $i . '@test.com',
                'name' => 'User' . $i,
                'password' => Hash::make('12345678'),
                'gender' => 'Male', // or 'Female'
                'address' => 'Address' . $i,
                'city' => 'City' . $i,
                'state' => 'State' . $i,
                'zip' => '6300' . $i,
            ]);
        }

        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(VariantsSeeder::class);
    }
}
