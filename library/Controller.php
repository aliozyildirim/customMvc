<?php
/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 26/05/2018
 * Time: 12:09
 */

namespace Library;


class Controller
{
    public $params;

    /**
     * @param $key
     * @param $value
     * data parametresi kullanilmamasi durumunda fonksiyon ile view klasoru altindaki dosyalara istenilen datayi assign eder.
     */
    public function assign($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @param $viewName
     * @param array $data Frontende datayi assaign eder
     */
    public function render($viewName, $data = [])
    {
        require_once('../view/' . $viewName . '.php');
    }


    /**
     * modeli load etmek icin yazildi..
     * Model.php icerisinde de yapilabilirdi fakat Controllerin tekrardan Model den extend olmasini istemedigimizden burada yapildi
     * @param $name
     * @return mixed
     */
    public function load($name)
    {
        $path = 'model/' . $name . 'Model';

        $class_file = DIR . DS . $path . '.php';

        $modelName = 'App\\Model\\' . $name . 'Model';

        if (file_exists($class_file)) {

            require_once($class_file);

            return new $modelName;
        } else {
            die('we have a problem');
        }
    }

}