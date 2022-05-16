<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Url;
use Phalcon\Di\DiInterface;
use Phalcon\Mvc\ViewBaseInterface;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Steram;

$container = new FactoryDefault();



$container->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        $view->registerEngines(
            [
                '.volt' => function (ViewBaseInterface $view) {
                    $volt = new Volt($view, $this);
                    $volt->setOptions(
                        [
                            'always'    => true,
                            'extension' => '.php',
                            'separator' => '_',
                            'stat'      => true,
                            'prefix'    => '-prefix-',
                            'path' => function (string $templatePath) {
                                $fileName = basename($templatePath);
                                
                                $dirPath = str_replace(APP_PATH, '/', dirname($templatePath));
                                echo $dirPath;
                                if (true !== is_dir(BASE_PATH . '/cache/' . $dirPath)) {
                                    mkdir(
                                        BASE_PATH . '/cache/' . $dirPath,
                                        0777,
                                        true
                                    );
                                }
                                return  BASE_PATH . '/cache/' . $dirPath . '/' . $fileName . '.php';
                            }
                        ]
                    );
                    
                    return $volt;
                }
            ]
        );

        return $view;
    }
);

$container->set(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('/');

        return $url;
    }
);
//echo  $config->database->host, ' ', $config->database->username, ' ', $config->database->password, ' ', $config->database->name;
$container->set(
    "db",
    function () use ($config) {
        return new Mysql(
            [
                "host"     => $config->database->host,
                "username" => $config->database->username,
                "password" => $config->database->password,
                "dbname"   => $config->database->name,
            ]
        );
    }
);

$container->set(
    "session",
    function () {
        $session = new Manager();
        $files   = new Steram(
            [
                'savePath' => '/tmp'
            ]
        );
        $session->setAdapter($files);
        $session->start();
        return $session;
    }
);