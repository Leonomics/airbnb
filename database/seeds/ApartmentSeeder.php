<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Apartment;
use App\User;
use App\Service;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartments = config('apartments');
        $user_ids = User::all()->pluck('id');
        $services = Service::all()->pluck('id')->toArray();

        foreach ($apartments as $apartment) {
            $a = new Apartment();
            
            $a->title = $apartment['title'];
            $a->user_id = $faker->randomElement($user_ids);
            $a->rooms_number = $apartment['rooms_number'];
            $a->beds_number = $apartment['beds_number'];
            $a->bath_number = $apartment['bath_number'];
            $a->meters = $apartment['meters'];
            $a->address = $apartment['address'];
            $a->latitude = $apartment['latitude'];
            $a->longitude = $apartment['longitude'];
            $a->city = $apartment['city'];
            $a->image = $apartment['image'];
            $a->price = $apartment['price'];
            
            $a->save();

            $serviceIds = $faker->randomElements($services, $faker->numberBetween(1, 6));
            $a->services()->sync($serviceIds);
        }
    }
}
