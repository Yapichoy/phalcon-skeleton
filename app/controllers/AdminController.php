<?php

use Phalcon\Mvc\Controller;
use Models\Admins;

class AdminController extends Controller {

    public function indexAction()
    {
        $title = "Admin/index";

        $this->view->title = $title;
    }

    public function addAction()
    {
        $admin = new Admins();
        
        $admin->assign(
            [
                'name' => 'Vladislav',
                'email' => 'vladislav.kuch@secure12.net',
                'password' => '123456'
            ],
            [
                'name',
                'email',
                'password'
            ]
        );
        print_r("Save admin <br />");
        //$success = $admin->save();

        return 'User saved ' . $success;
    }
}