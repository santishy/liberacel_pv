<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        $categories = Category::factory()->count(50)->create();
        $categories->each(function($category){
            Product::factory()->times(rand(12,40))->create(['category_id' => $category->id]);
        });
        
    }
}
