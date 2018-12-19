<?php
/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 25/05/2018
 * Time: 15:49
 */

namespace App\Model;

use App\cookie;
use App\session;
use Library\Model;

class memberModel extends Model
{
    public static $isLogout = false;

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Logout
     */
    public static function logout()
    {
        if (self::$isLogout) {
             return;
        }

        // session sil
        session::delete('member');

        // cookie sil
        cookie::delete('member', time() - 8640000);

        if (session_status() === 2) {
            session_destroy();
        }

        self::$isLogout = true;
    }

    /**
     * Kullaniciya ait fieldi sessiondan alir
     * @param null $field
     * @return bool
     */
    public static function get($field = null)
    {
        if (!self::loggedIn() || empty($field)) {
            return false;
        }

        $session = Session::get('member');

        return $session[$field];
    }

    // Kullanici login mi ?
    public static function loggedIn()
    {

        if (cookie::get('name')) {
            return false;
        }

        if (session::get('member')) {
            return true;
        }

        return false;
    }

    /**
     * @param $membeerId
     */
    public function loginUser($name, $password)
    {

        try {
            $userData = $this->select('users',
                'name = :name AND password = :password',
                [
                    ':name' => $name,
                    ':password' => md5($password),
                ]
            );

            if ($userData) {
                //         userdatayi sessiona ekle
                self::setSessionUser($userData);
            } else {
                LOG_ALERT;
            }

        } catch (\Exception $exception) {
            $exception->getMessage();
        }

        return $userData;
    }

    public static function setSessionUser($user)
    {
        // session
        session::set('member', $user);

        // cookie
        cookie::set('member', $user['name'], time() + 8640000, '/');
    }
}