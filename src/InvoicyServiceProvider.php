<?php

namespace Invoicy;

use Illuminate\Support\ServiceProvider;

class InvoicyServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath($raw = __DIR__ . '/../config/invoicy.php') ?: $raw;

        $this->publishes([
            $source => config_path('invoicy.php')
        ]);
    }
}