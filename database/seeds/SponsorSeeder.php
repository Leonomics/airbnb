<?php

use App\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = config('sponsor');

        foreach($plans as $plan) {
            $p = new Sponsor();
            $p->plan = $plan['plan'];
            $p->price = $plan['price'];
            $p->duration = $plan['duration'];

            $p->save();
        }

    }
}
