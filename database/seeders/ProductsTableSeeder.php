<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Product 1',
                'de' => 'Description for Product 1',
                'price' => '100.00',
                'image' => 'product1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 2',
                'de' => 'Description for Product 2',
                'price' => '200.00',
                'image' => 'product2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 3',
                'de' => 'Description for Product 3',
                'price' => '300.00',
                'image' => 'product3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
