<?php

$container->set(
    "router", 
    function () {
        $router = new \Phalcon\Mvc\Router();

        $router->setDefaultModule("web");

        $router->setDefaultNamespace("App\Web\Controller");

        return $router;
    }
);