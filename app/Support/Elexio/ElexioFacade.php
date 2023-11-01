<?php

namespace App\Support\Elexio;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Support\Elexio\Elexio login(string $username = '', string $password = '')
 * @method static array events(\Illuminate\Support\Carbon $start, \Illuminate\Support\Carbon $end)
 */
class ElexioFacade extends Facade
{
    /**
     * Get the registered name of the facade.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'elexio';
    }
}
