<?php

namespace Jacksonit\Captcha\Facades;

use Illuminate\Support\Facades\Facade;

class CaptchaGIFCharge extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CaptchaCharge';
    }
}