<?php
/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 25/05/2018
 * Time: 15:46
 */

ini_set('display_errors', 1);


require_once '../library/Config.php';
require_once '../app/bootstrap.php';


//Routelari handle eder.. Tum rootlar
$router = require_once '../app/routes.php';
$router->handle();