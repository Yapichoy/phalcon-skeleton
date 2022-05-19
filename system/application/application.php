<?php

use Phalcon\Mvc\Application;

$application = new Application($container);

$application->registerModules(
    [
        'admin' => [
            'className' => \App\Admin\Module::class,
            'path'      => APP_PATH . '/Admin/Module.php',
        ],
        'web'  => [
            'className' => \App\Web\Module::class,
            'path'      => APP_PATH . '/Web/Module.php',
        ]
    ]
);

$url = $_SERVER["REQUEST_URI"];

try {
    $response = $application->handle(
        $url
    );
    $response->send();
} catch (\Exception $e) {
	echo $e->getMessage() . '<br>' . $e->getTraceAsString();
}