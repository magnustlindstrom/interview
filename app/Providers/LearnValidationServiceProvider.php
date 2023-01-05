<?php

namespace App\Providers;

use App\Services\LearnValidationService;
use Illuminate\Support\ServiceProvider;

class LearnValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        return $this->singleton(LearnValidationService::class, function($app){ return new LearnValidationService(); });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
