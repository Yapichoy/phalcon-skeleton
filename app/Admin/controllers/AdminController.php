<?php
namespace App\Admin\Controller;

use Phalcon\Mvc\Controller;
use Models\Admins;
use Phalcon\Security\JWT\Token\Parser;

class AdminController extends Controller {

    public function indexAction()
    {
        $title = "Admin/index";

        $this->view->title = $title;
    }

    public function addAction()
    {
        $admin = new Admins();
        
        $obj = [
            'name' => 'Vladislav',
            'email' => 'vladislav.kuch@secure12.net',
            'password' => '123456'
        ];

        $admin->assign(
            $obj,
            [
                'name',
                'email',
                'password'
            ]
        );

        $name = 'Vladislav';
        $secured = $this->crypt->encrypt(json_encode($obj));

        $dectiption = json_decode($this->crypt->decrypt($secured), true);

        return $this->response;
    }
}