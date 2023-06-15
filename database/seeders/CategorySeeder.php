<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'catName' => $faker->word,
                'catDesc' => $faker->sentence,
                'catImg' => $faker->randomElement(['banner_img_01.jpg', 'banner_img_02.jpg', 'banner_img_03.jpg']),
            ]);
        }
    }
}
