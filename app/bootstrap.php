<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app['console'] = function () {
    return new \Symfony\Component\Console\Application();
};

$serviceProviderClasses = require_once __DIR__ . '/providers.php';

foreach ($serviceProviderClasses as $serviceProviderClass) {
    $app->register(new $serviceProviderClass);
}

return $app;