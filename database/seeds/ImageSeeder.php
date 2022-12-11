<?php

use App\Apartment;
use App\Image;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartment_ids = Apartment::all()->pluck('id');

        for($i = 0; $i < 15; $i++) {
            $image = new Image();
            $image->path = $faker->imageUrl(640, 480, 'animals', true);
            $image->apartment_id = $faker->randomElement($apartment_ids);

            $image->save();
        }
    }
}
