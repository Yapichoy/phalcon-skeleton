<?php

use Phalcon\Mvc\Controller;

class UpController extends Controller
{
    public function indexAction()
    {
        $title = "Up/index";

        $this->view->title = $title;
    }

    public function dieAction()
    {
        return '<h1>Die MF Die!</h1>';
    }
}