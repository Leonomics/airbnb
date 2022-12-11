<?php

use App\Apartment;
use App\View;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ViewSeeder extends Seeder
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
            $v = new View();
            $v->ip = $faker->ipv4();
            $v->date = $faker->date();
            $v->apartment_id = $faker->randomElement($apartment_ids);

            $v->save();
        }
    }
}
