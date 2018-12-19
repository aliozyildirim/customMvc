<?php
/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 25/05/2018
 * Time: 15:50
 */

namespace App\Controller;

use Library\Controller;

class bookController extends Controller
{
    function __construct()
    {
    }

    public function indexAction()
    {

        $books = [
            'books' =>[
                'book' => 'asd', 'book2' => 'asdas'
            ]

        ];
        $this->render('book', $books);
    }
}