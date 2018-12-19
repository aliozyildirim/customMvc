<?php


/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 25/05/2018
 * Time: 15:49
 */

namespace App;


class cache
{
    /**
     * @param $name
     * @param $value
     * @param int $time
     * @param string $path
     */
    public static function set($name, $value, $time = 120)
    {
        return apc_store($name, $value, $time);
    }

    /**
     * @param $key
     * @return bool
     */
    public static function get($key)
    {
        return apc_fetch($key);
    }
}