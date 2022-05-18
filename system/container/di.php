<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Di\DiInterface;
use Phalcon\Session\Adapter\Steram;

$container = new FactoryDefault();

$container->setShared(
    'voltService',
    function (\Phalcon\Mvc\ViewBaseInterface $view) {
        $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $this);
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
);

$container->set(
    'url',
    function () {
        $url = new \Phalcon\Url();
        $url->setBaseUri('/');
        return $url;
    }
);

$container->set(
    "db",
    function () use ($config) {
        return new \Phalcon\Db\Adapter\Pdo\Mysql(
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
        $session = new \Phalcon\Session\Manager();
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

$container->set(
    'security',
    function () {
        $security = new \Phalcon\Security();

        $security->setWorkFactor(12);

        return $security;
    },
    true
);

$container->set(
    'crypt',
    function () use ($config) {
        $crypt = new \Phalcon\Crypt();
        $crypt->setCipher('aes256')->useSigning(false);
        $crypt->setKey(
            $config->security->encryption_key
        );

        return $crypt;
    },
    true
);