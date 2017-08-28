<?php

namespace Google\Facades;

use Illuminate\Support\Facades\Facade;
use Google\Managers\Google as GoogleManager;

class Google extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return GoogleManager::class;
    }
}
