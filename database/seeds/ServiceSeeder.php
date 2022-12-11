<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = Service::AVAILABLE_SERVICE;

        foreach($services as $name) {
            $service = new Service();
            
            $service->name = $name;
            
            $service->save();
        }
    }
}
