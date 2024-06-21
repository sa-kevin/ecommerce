<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Laptop',
            'description' => 'An High perf laptop.',
            'price' => 999.99,
            'quantity' => 50,
            'category_id' => 1,
        ]);
        Product::create([
            'name' => 'Book',
            'description' => 'Cool book from a other world.',
            'price' => 39.99,
            'quantity' => 100,
            'category_id' => 2,
        ]);
    }
}
