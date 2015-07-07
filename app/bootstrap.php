<?php

require_once __DIR__.'../vendor/autoload.php';

$app = new Silex\Application();

$app['console'] = function(){
    return new \Symfony\Component\Console\Application();
};

return $app;
