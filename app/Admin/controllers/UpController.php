<?php
namespace App\Admin\Controller;

use Phalcon\Mvc\Controller;

class UpController extends Controller
{
    public function indexAction()
    {
        print_r($this);
        return '<h1>Up COntroller!</h1>';
    }

    public function dieAction()
    {
        return '<h1>Die MF Die!</h1>';
    }
}