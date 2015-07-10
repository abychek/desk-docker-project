<?php

require_once __DIR__ . '/../vendor/autoload.php';

function app_path($path = '/')
{
    $rootDir = '/' . explode('/', __DIR__)[1];
    return preg_replace('/\/+/', '/', $rootDir . $path);
}

$app = new Silex\Application();

$app['console'] = function () {
    return new \Symfony\Component\Console\Application();
};

if (file_exists(app_path('/.env'))) {
    $dotenv = new \Dotenv\Dotenv(app_path());
    $dotenv->load();
}

$serviceProviderClasses = require_once __DIR__ . '/providers.php';

foreach ($serviceProviderClasses as $serviceProviderClass) {
    $app->register(new $serviceProviderClass);
}

return $app;