<?php


/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 25/05/2018
 * Time: 15:49
 */

namespace App;


class cookie
{
    /**
     * @param $name
     * @param $value
     * @param int $time
     * @param string $path
     */
    public static function set($name, $value, $time = 86400 * 30, $path = '/')
    {
        setcookie($name, $value, time() + $time, $path);
    }

    /**
     * @param $key
     * @return bool
     */
    public static function get($key)
    {
        if (!empty($_COOKIE[$key])) {
            return $_COOKIE[$key];
        } else {
            return false;
        }
    }


    /**
     * @param $key
     */
    public static function delete($key, $time = 86400 * 30)
    {

        if (isset($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
            setcookie($key, '', time() - $time, '/');
        }
    }
}