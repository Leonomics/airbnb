<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useTailwind();

        //singleton
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                    [
                        'environment' =>'sandbox',
                        'merchantId' => '9q6qmt8psvx7cbqk',
                        'publicKey' => 'my835sr5qc6gv565',
                        'privateKey' => 'd760d1d1e6a0a350a93ee329914b170b'
                    ]
            );
        });
    }
}
