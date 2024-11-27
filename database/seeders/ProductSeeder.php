<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('id')->toArray();
        $products = Product::factory()->count(50)->create();

        foreach ($products as $product) {
            $product->category_id = $categoryIds[array_rand($categoryIds)];
            $product->save();
            $product->stocks()->create([
                'quantity' => rand(1, 10),
                'attributes' => json_encode(
                    [
                        [
                            'attribute_id' => 1,
                            'value_id' => rand(1, 3),
                        ],
                        [
                            'attribute_id' => 2,
                            'value_id' => rand(4, 5),
                        ],
                    ],
                ),
            ]);
        }
    }
}
