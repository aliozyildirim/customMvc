<?php


/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 25/05/2018
 * Time: 15:49
 */
namespace App;

use Library\Helper;


// Helper kullanmadan direk $_SESSION a key to atayabilirdik ama ileride cok isimize yarayacak.

class session
{
    private static $sessionInstance = null;

    /**
     * Constructor
     */
    public function __construct()
    {

        // session yoksa baslatiyoruz.
        if (session_status() != PHP_SESSION_ACTIVE)
        {
            session_start();
        }
    }


    /**
     * Singleton
     * @return session
     */
    public static function singleton()
    {
        if (!isset(self::$sessionInstance)) {
            self::$sessionInstance = new self();
        }
        return self::$sessionInstance;
    }

    /**
     *
     * @param string $key
     * @param $value
     */
    public static function set($key, $value)
    {
        Helper::array_set($_SESSION, $key, $value);
    }

    /**
     * Get a session.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key)
    {
        return Helper::array_get($_SESSION, $key);
    }

    /**
     * Delete a session.
     *
     * @param string $key
     */
    public static function delete($key)
    {
        Helper::array_forget($_SESSION, $key);
    }
}