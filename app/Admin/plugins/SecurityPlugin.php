<?php

namespace App\Admin\Plugins;

use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

class SecurityPlugin extends Injectable
{
    public function beforeExecuteRoute(
        Event $event, 
        Dispatcher $containerspatcher
    ) {
        $session = $this->session->get('session');
        $flag_login = false;
        if (isset($session['is_log_in']) && $session['is_log_in']) {
            $flag_login = true;
        }

        $controller = $containerspatcher->getControllerName();
        $action     = $containerspatcher->getActionName();

        if ($controller !== "auth") {
            if (!$flag_login) {
                $this->flash->error(
                    "You should be logged in"
                );
    
                $containerspatcher->forward(
                    [
                        'controller' => 'auth',
                        'action'     => 'index',
                    ]
                );
    
                return false;
            }
        }
    }
}