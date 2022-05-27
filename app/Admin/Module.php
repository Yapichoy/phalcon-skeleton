<?php

namespace App\Admin;

use Phalcon\Autoload\Loader;
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

        $loader->setDirectories(
            [
                APP_PATH . '/Admin/controllers/',
                APP_PATH . '/Admin/models/',
                APP_PATH . '/Admin/views/',
                APP_PATH . '/Admin/helpers/',
                APP_PATH . '/Admin/plugins/',
            ]
        );
        
        $loader->setNamespaces(
            [
                'App\Admin\Controller'  => APP_PATH . '/Admin/controllers/',
                'App\Admin\Models'      => APP_PATH . '/Admin/models/',
                'App\Admin\Views'       => APP_PATH . '/Admin/views/',
                'App\Admin\Helpers'     => APP_PATH . '/Admin/helpers/',
                'App\Admin\Plugins'     => APP_PATH . '/Admin/plugins/',
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

        $container->set(
            'dispatcher',
            function () {
                $eventsManager = new \Phalcon\Events\Manager();
        
                $eventsManager->attach(
                    'dispatch:beforeExecuteRoute',
                    new \App\Admin\Plugins\SecurityPlugin()
                );
        
                $containerspatcher = new \Phalcon\Mvc\Dispatcher();
        
                $containerspatcher->setEventsManager($eventsManager);
        
                return $containerspatcher;
            }
        );
    }
}