<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products;
use App\Models\Categories;
use App\Models\ProductsCategories;

class ProductsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Products::all();
        $categories = Categories::all();

        foreach ($products as $product) {
            $max_category = rand(1, count($categories));
            $count = 1;
            foreach ($categories as $category) {
                if($count <= $max_category) {
                    ProductsCategories::insert([
                        'products_id' => $product->id,
                        'categories_id' => $category->id
                    ]);
                    $count += 1;
                }                  
            }
        }

    }
}
