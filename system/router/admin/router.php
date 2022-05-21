<?php

$container->set(
    "router", 
    function () {
        $router = new \Phalcon\Mvc\Router();

        $router->setDefaultModule("admin");

        $router->setDefaultNamespace("App\Admin\Controller");

        return $router;
    }
);