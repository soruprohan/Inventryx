<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Computers',
            'Mobile Phones',
            'Tablets',
            'Laptops',
            'Accessories',
            'Cameras',
            'Audio',
            'Gaming',
            'Networking',
            'Storage',
            'Monitors',
            'Printers',
            'Software',
        ];

        foreach ($categories as $category) {
            ProductCategory::create([
                'category_name' => $category,
                'category_slug' => Str::slug($category),
            ]);
        }
    }
}
