<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categoryIds = DB::table('categories')->pluck('category_id');

        for ($i = 0; $i < 10; $i++) {
            $categoryId = $faker->randomElement($categoryIds);

            Brand::create([
                'name' => $faker->company,
                'description' => $faker->paragraph,
                'category_id' => $categoryId,
                'logo' => $faker->randomElement(['banner_img_01.jpg', 'banner_img_02.jpg', 'banner_img_03.jpg']),
            ]);
        }
    }
}
