<?php

namespace Viewflex\Zoap\Demo;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use SoapFault;
use Viewflex\Zoap\Demo\DemoProvider as Provider;

/**
 * An example of a class that is used as a SOAP gateway to application functions.
 */
class DemoService
{

    /**
     * Returns an array of products by search criteria.
     *
     * @return \App\Models\UserSoap[]
     * @throws SoapFault
     */
    public function getProducts()
    {
        return DB::connection("account")->table("users")->limit(5)->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Utility
    |--------------------------------------------------------------------------
    */

    /**
     * Convert array of KeyValue objects to associative array, non-recursively.
     *
     * @param \Viewflex\Zoap\Demo\Types\KeyValue[] $objects
     * @return array
     */
    protected static function arrayOfKeyValueToArray($objects)
    {
        $return = array();
        foreach ($objects as $object) {
            $return[$object->key] = $object->value;
        }

        return $return;
    }

}
