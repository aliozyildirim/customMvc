<?php

/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 27/05/2018
 * Time: 00:59
 */


/**
 * @param $msg
 * @param $success
 */

namespace Library;

class JsonResponse
{

    /**
     * @param $msg
     * @param $success
     * @param string $redirect
     */
    public static function json_response($msg, $success, $redirect = '/member')
    {
        $data = [];

        $data['message'] = $msg;
        $data['success'] = $success;
        $data['redirect'] = $redirect;

        header('Content-Type: application/json; charset=utf-8');
        die(json_encode($data));
    }
}
