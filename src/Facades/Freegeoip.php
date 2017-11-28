<?php

namespace Siro\Freegeoip\Facades;

use Illuminate\Support\Facades\Facade;

class Freegeopip extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Siro\Freegeoip\Freegeoip';
    }
}