<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 07.07.15
 * Time: 18:45
 */
require_once("../vendor/autoload.php");

$app = new Silex\Application();

$app['console'] = function(){
    return new \Symfony\Component\Console\Application();
};

return $app;