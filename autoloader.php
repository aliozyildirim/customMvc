<?php
///**
// * Created by PhpStorm.
// * User: aliozyildirim
// * Date: 25/05/2018
// * Time: 15:49
// */
//

define('DIR', __DIR__);
define('DS', DIRECTORY_SEPARATOR);
define('Controller', DIR . DS . 'controller');
define('Model', DIR . DS . 'model');
define('View', DIR . DS . 'view');


define('load_classes', serialize([Model, View, Controller]));


function autoloader($class)
{
    //Namespaceleri yazilma ihtimallerine karsi yapildi.
    $arr = array(
        "App\Controller\\" => "controller/",
        "App\Model\\" => "model/",
        "App\\" => "app/",
        "App\View\\" => "view/",
        "Library\\" => "library/"
    );

    $class = strtr($class, $arr);


    $class_file = DIR . DS . $class . '.php';

    if (file_exists($class_file)) {
        require_once $class_file;
    } else {
        foreach (unserialize(load_classes) as $classPath) {
            $class_file = $classPath . DS . $class . '.php';

            if (file_exists($class_file)) {
                require $class_file;
            }
        }
    }
}

spl_autoload_register('autoloader');