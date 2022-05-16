<?php

use Phalcon\Mvc\Application;

$application = new Application($container);
$url = $_SERVER["REQUEST_URI"];
try {
    $response = $application->handle(
        $url
    );
    $response->send();
} catch (\Exception $e) {
	echo $e->getMessage();
}