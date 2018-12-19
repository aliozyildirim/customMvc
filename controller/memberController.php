<?php
/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 25/05/2018
 * Time: 15:50
 */

namespace App\Controller;

use App\Model\memberModel;
use Library\Controller;
use Library\JsonResponse;


class memberController extends Controller
{
    public function indexAction()
    {
        $this->render('member');
    }

    public function loginAction()
    {

        if (!$_POST) {
            return true;
        }

        $name = $_POST['name'];
        $password = $_POST['password'];

        if (empty($name) || empty($password)) {
            //throw  new \Exception('Lutfen');
        } else {

            $member = new memberModel();
            $userData = $member->loginUser($name, $password);

            if (!empty($userData)) {
                JsonResponse::json_response('Basarili', true, '/member');

            } else {
                JsonResponse::json_response('User Bulunamadi', false, '/member');
            }
        }

    }

    public function logoutAction()
    {
        $member = new memberModel();
        $member::logout();
        
        JsonResponse::json_response('Basarili', true, '/custommvc/member');
    }

}