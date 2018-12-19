<?php

/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 25/05/2018
 * Time: 15:49
 */

use Library\Router;

/**
 * url -> ['controller', 'action', 'view]
 */
$routesArray = [
    'book' => ['book', 'index', 'book'],
    'member' => ['member', 'index', 'member'],
    'login' => ['member', 'index', 'member'],
    'member/login' => ['member', 'login', 'login'],
    'member/logout' => ['member', 'logout', 'login'],
];

$router = new Router();

// TODO eger istenirse yaml dosyasindanda cekebilicek hale getirebiliriz.
// Buradaki amac tek tek Route->add degilde tum rootlari array altinda toplamak..
foreach ($routesArray as $key => $value) {
    $router->add($key,
        [
            'controller' => $value[0],
            'action' => $value[1],
            'view' => $value[2],
        ]
    );
}

return $router;