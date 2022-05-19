<?php
namespace App\Admin\Controller;

use Phalcon\Mvc\Controller;
use App\Admin\Models\Admin;

class AuthController extends Controller {

    public function indexAction()
    {

    }

    public function registerAction()
    {
        if ($this->request->isPost()) {
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email', 'email', null);
            $password = $this->request->getPost('password');
            $confirm_password = $this->request->getPost('confirm_password');
            try {

                if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
                   throw new \Exception("All fields shouldn't be empty!");
                } 

                if ($password !== $confirm_password) {
                    throw new \Exception("Password error!");
                }

                $admin = new Admin();

                $data_obj = [
                    'name'      => $name,
                    'email'     => $email,
                    'password'  => $this->security->hash($password)
                ];

                $admin->assign($data_obj);

                $status = $admin->create();

                $result = [
                    'status'    => $status,
                    'message'   => '',
                    'result'    =>  array_merge($data_obj, ['admin_id' => $admin->id])  
                ];
            } catch(\Exception $e) {
                $result = [
                    'status'    => false,
                    'message'   => $e->getMessage(),
                    'result'    => [] 
                ];
            }
            
            return $this->response
                    ->setJsonContent($result);
        }
        
    }
}