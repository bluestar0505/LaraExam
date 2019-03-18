<?php
/**
 * Created by PhpStorm.
 * User: klegotin
 * Date: 26/07/16
 * Time: 15:15
 */

namespace App\Modules\PayPal\Facade;

use Illuminate\Support\Facades\Facade;

class PayPal extends Facade
{

    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor()
    {
        return 'PayPal';
    }

}