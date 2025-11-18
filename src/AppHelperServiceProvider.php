<?php

namespace AlifAhmmed\HelperPackage;

use Illuminate\Support\ServiceProvider;
use AlifAhmmed\HelperPackage\Helpers\Helper;

class AppHelperServiceProvider extends ServiceProvider
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
