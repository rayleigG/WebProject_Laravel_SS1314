<?php

namespace Database\Seeders;

use App\Models\Slideshow;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlideshowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $orderNum = 1;
        for ($i = 0; $i < 30; $i++) {
            Slideshow::create([
                'title' => $faker->sentence(5),
                'subtitle' => $faker->sentence(7),
                'text' => $faker->sentence(7),
                'active' => $faker->randomElement([0, 1]),
                'img' => $faker->randomElement(['banner_img_01.jpg', 'banner_img_02.jpg', 'banner_img_03.jpg']),
                'orderNum' => $orderNum++,
                'link' => "#",
            ]);
        }
    }
}
