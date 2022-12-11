<?php

use App\Apartment;
use App\Message;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartment_ids = Apartment::all()->pluck('id');
        
        for ($i = 0; $i < 50; $i++) {
            $message = new Message();
            $message->text = $faker->paragraphs(rand(10, 20), true);
            $message->email = $faker->email();
            $message->name = $faker->firstName();
            $message->surname = $faker->lastName();
            $message->viewed = false;
            $message->apartment_id = $faker->randomElement($apartment_ids);

            $message->save();
        }
    }
}
