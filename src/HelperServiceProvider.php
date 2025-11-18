<?php

namespace AlifAhmmed\HelperPackage; // singular, matches composer.json

use Illuminate\Support\ServiceProvider;
use AlifAhmmed\HelperPackage\Helpers\Helper;

class HelperServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('helper', function () {
            return new Helper();
        });
    }

    public function boot()
    {
        //
    }
}
