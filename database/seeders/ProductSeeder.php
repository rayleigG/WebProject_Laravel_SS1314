<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categoryIds = DB::table('categories')->pluck('category_id');
        $brandIds = DB::table('brands')->pluck('brand_id');
        $orderNum = 11;
        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'pname' => $faker->word,
                'price' => $faker->randomFloat(2, 10, 100),
                'quantity' => $faker->numberBetween(1, 100),
                'active' => $faker->boolean,
                'img' => $faker->randomElement(['shop_07.jpg', 'shop_03.jpg', 'shop_10.jpg']),
                'category_id' => $faker->randomElement($categoryIds),
                'brand_id' => $faker->randomElement($brandIds),
                'orderNum' => $orderNum++,
            ]);
        }
    }
}
