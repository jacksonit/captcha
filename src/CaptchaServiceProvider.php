<?php

namespace Jacksonit\Captcha;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

/**
 * ServiceProvider
 *
 * The service provider for the modules. After being registered
 * it will make sure that each of the modules are properly loaded
 * i.e. with their routes, views etc.
 *
 * @author Cao Son <son.caoxuan92@gmail.com>
 * @package Jacksonit\Captcha
 */
class CaptchaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish config files

    }

    public function register()
    {
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('CaptchaGIFCharge', 'Jacksonit\Captcha\Facades\CaptchaGIFCharge');
        });

        $this->app->bind('CaptchaCharge', CaptchaCharge::class);
    }
}