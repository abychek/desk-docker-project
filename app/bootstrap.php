<?php

require_once("../vendor/autoload.php");

$app = new Silex\Application();

$app['console'] = function(){
    return new \Symfony\Component\Console\Application();
};

return $app;
