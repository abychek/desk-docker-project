<?php

namespace Desk\Core;


use Desk\Core\Commands\Config\BuildCommand;
use Desk\Core\Commands\Config\GetCommand;
use Desk\Core\Commands\Database\CreateCommand;
use Desk\Core\Commands\Database\DropCommand;
use Silex\Application;
use Silex\ServiceProviderInterface;

class CoreServiceProvider implements ServiceProviderInterface
{

    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        $app['database.connection'] = $app->share(function () {
            if (!(getenv('DB_HOST') && getenv('DB_PORT')
                && getenv('DB_PORT') && getenv('DB_PORT'))
            ) {
                throw new \RuntimeException('Database settings not found!');
            }
            $connectionString = 'pgsql:host=' . getenv('DB_HOST') . ';port=' .
                getenv('DB_PORT') . ';user=' . getenv('DB_USER') . ';password=' . getenv('DB_PASSWORD');
            return new \PDO($connectionString);
        });

        if (isset($app['console'])) {
            $app['console'] = $app->share($app->extend('console', function ($console) use ($app) {
                $console->add(new BuildCommand());
                $console->add(new CreateCommand($app));
                $console->add(new DropCommand($app));
                $console->add(new GetCommand());

                return $console;
            }));
        }
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {

    }


}
