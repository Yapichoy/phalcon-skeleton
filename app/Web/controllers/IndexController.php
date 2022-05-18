<?php
namespace App\Web\Controller;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $title = "Index/index";
        echo 'Web Module';
        $this->view->title = $title;
    }
}