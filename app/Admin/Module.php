<?php

namespace App\Admin;

use Phalcon\Loader;
use Phalcon\Di\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(
        DiInterface $container = null
    )
    {
        $loader = new Loader();

        $loader->registerDirs(
            [
                APP_PATH . '/Admin/controllers/',
                APP_PATH . '/Admin/models/',
                APP_PATH . '/Admin/views/',
            ]
        );
        
        $loader->registerNamespaces(
            [
                'App\Admin\Controller'  => APP_PATH . '/Admin/controllers/',
                'App\Admin\Models'      => APP_PATH . '/Admin/models/',
                'App\Admin\Views'       => APP_PATH . '/Admin/views/'
            ]
        );

        $loader->register();
    }

    public function registerServices(DiInterface $container)
    {
        // Registering a dispatcher
        $container->set(
            'dispatcher',
            function () {
                $dispatcher = new Dispatcher();
                $dispatcher->setDefaultNamespace(
                    'App\Admin\Controller'
                );

                return $dispatcher;
            }
        );

        // Registering the view component
        $container->set(
            'view',
            function () {
                $view = new View();

                $view->setViewsDir(
                    APP_PATH . '/Admin/views/'
                );

                $view->registerEngines(
                    [
                        '.volt' => 'voltService',
                    ]
                );

                return $view;
            }
        );
    }
}