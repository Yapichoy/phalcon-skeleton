<?php
namespace App\Admin\Controller;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;
use App\Admin\Models\Admin;
use App\Admin\Models\Session;
use App\Admin\Helpers\AuthHelper;

class AuthController extends Controller {

    private function _redirectIfAuth()
    {
        $session = $this->session->get('session');
        $flag_login = false;
        if (isset($session['is_log_in']) && $session['is_log_in']) {
            $flag_login = true;
        }

        if ($flag_login) {
            $this->response = $this->response->redirect(
                '/',
                true
            );

            return false;
        }
        return true;
    }
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        return $this->_redirectIfAuth();
    }

    public function indexAction()
    {
        if ($this->request->isPost()) {
            $email = $this->request->getPost('email', 'email', null);
            $password = $this->request->getPost('password');
            $flag_remember = $this->request->getPost('flag_remember', bool, false);

            try {
                if (empty($email) || empty($password)) {
                    throw new \Exception("All fields shouldn't be empty!");
                }
                $admin = Admin::findFirst("email = '$email'");
                
                if (empty($admin)) {
                    throw new \Exception("Wrong email or password!");
                }
                $password = md5($password);

                if ($password !== $admin->password) {
                    throw new \Exception("Wrong email or password!");
                }

                $this->session->set(
                    'session',
                    [
                        'admin_id'  => $admin->id,
                        'is_log_in' => true,
                        'flag_remember' => $flag_remember
                    ]
                );

                $result = [
                    'status'    => true,
                    'message'   => '',
                    'result'    =>  $admin  
                ];
            } catch (\Throwable $e) {
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

                if (AuthHelper::isAdminExist($email)) {
                    throw new \Exception("Admin with email '$email' already exist!");
                }

                $admin = new Admin();

                $data_obj = [
                    'name'      => $name,
                    'email'     => $email,
                    'password'  => md5($password)
                ];

                $admin->assign($data_obj);

                $status = $admin->create();
                $this->session->set(
                    'session',
                    [
                        'admin_id'  => $admin->id,
                        'is_log_in' => true,
                        'flag_remember' => false
                    ]
                );
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