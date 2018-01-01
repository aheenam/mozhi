<?php
namespace Aheenam\Mozhi\Facades;

use Illuminate\Support\Facades\Facade;

class Mozhi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mozhi';
    }

    /**
     * include the routes for mozhi
     */
    public static function routes ()
    {
        require __DIR__ . '/../routes/web.php';
    }

}