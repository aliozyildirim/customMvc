<?php

/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 25/05/2018
 * Time: 15:49
 */

namespace Library;

class Router
{
    protected $routes;

    /**
     * @return mixed
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param $url
     * @param array $option
     */
    public function add($url, $option = [])
    {
        $this->routes[$url] = $option;

    }

    /**
     * requestUrl Get methoduyla gelen urllerin sonunda bulunan '/' isareti gozardi etmek icin koyuldi
     * actionName Controllerdeki function ismi
     * controllerName contoller dosyasi altindaki Contollerleri temsil ediyor.
     */
    public function handle()
    {
        // Url icerisinden ? ten sonrasini atiyoruz
        $url = $_SERVER['REQUEST_URI'];
        $tmp = explode('?', $url);
        $requestUrl = trim($tmp[0], '/');;

        foreach ($this->routes as $url => $options) {
            if ($requestUrl== $url) {
                // Namespace yazilmamissa patlamasin
                $controllerName = 'App\\Controller\\' . $options['controller'] . 'Controller';

                $actionName =  $options['action']. 'Action';

                $controller = new $controllerName;

                if (function_exists( $controller->$actionName())) {
                    $controller->$actionName();
                }

            }
        }
    }
}