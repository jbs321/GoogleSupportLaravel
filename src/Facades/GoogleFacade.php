<?php

namespace Google\Facades;

use Google\Managers\GoogleManager;
use Illuminate\Support\Facades\Facade;

class GoogleFacade extends Facade
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
