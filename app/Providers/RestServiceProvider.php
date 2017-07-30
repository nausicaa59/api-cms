<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\RestHelpers;

class RestServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    $this->app->singleton('RestHelpers', function($app) {
	        return new RestHelpers();
	    });
    }
}
