<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $title = "Index/index";

        $this->view->title = $title;
    }
}