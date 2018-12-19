<?php
/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 27/05/2018
 * Time: 02:45
 */

namespace Library;

// Tum arrayleri istenilen seviyelerde verir. amac ileride sessionun tum datalarini farkli arrayde tutmak
// Ornegin session::set('member.detail', $params ) in ciktisi
/*
 * [member] => Array
        (
            [detail] => Array
                (
                    [username] => username
                    [password] => password
                )

        )
 */

class Helper
{

    /**
     * @param $array
     * @param $key
     * @return mixed|null
     */
    public static function array_get($array, $key)
    {
        if (is_null($key)) return $array;

        if (isset($array[$key])) return $array[$key];

        // Key i explode edip varligina bakiyoruz.. varsa direk alip kullaniyoruz.
        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) or !array_key_exists($segment, $array)) {
                return false;
            }

            $array = $array[$segment];
        }

        return $array;
    }

    /**
     *
     * @param  array $array
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public static function array_set(&$array, $key, $value)
    {
        if (is_null($key)) {
            $array = $value;
            return;
        }

        $keys = explode('.', $key);

        // Keys i explode edip varligina bakiyoruz..array_shift ile ilk elemanini cikarip array icerisine atiyoruz.

        while (count($keys) > 1) {
            $key = array_shift($keys);

            if (!isset($array[$key]) or !is_array($array[$key])) {
                $array[$key] = array();
            }

            $array =& $array[$key];
        }

        $array[array_shift($keys)] = $value;
    }

    /**
     *
     * @param  array $array
     * @param  string $key
     * @return void
     */
    public static function array_forget(&$array, $key)
    {
        $keys = explode('.', $key);

        // Keys i explode edip varligina bakiyoruz..array_shift ile ilk elemanini cikarip array icerisine atiyoruz. sonrada unset ile siliyoruz.

        while (count($keys) > 1) {
            $key = array_shift($keys);

            if (!isset($array[$key]) or !is_array($array[$key])) {
                return;
            }

            $array =& $array[$key];
        }

        unset($array[array_shift($keys)]);
    }

}