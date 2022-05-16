<?php

use Phalcon\Loader;

$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
        APP_PATH . '/views/',
    ]
);

$loader->registerNamespaces(
    [
        "Models" => APP_PATH . "/models",
        "Controllers" => APP_PATH . "/controllers",
        "Views" => APP_PATH . "/views"
    ]
);

$loader->register();