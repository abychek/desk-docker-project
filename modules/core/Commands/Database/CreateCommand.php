<?php

namespace Desk\Core\Commands\Database;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends Command
{

    protected $app;

    /**
     * @param \Pimple $app
     */
    public function __construct(\Pimple $app)
    {
        parent::__construct();
        $this->app = $app;
    }

    protected function configure()
    {
        $this->setName('database:create')
            ->setDescription('Create database. Database name defined in database.env');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $dbName = getenv('DB_NAME');
            $lineChanged = $this->app['database.connection']->exec("CREATE DATABASE $dbName");
            var_dump($lineChanged);
            if ($lineChanged === false) {
                $output->writeln($this->app['database.connection']->errorInfo()[2]);
            } else {
                $output->writeln("Database $dbName created");
            }
        } catch (\PDOException $ex) {
            $output->writeln($ex->getMessage());
        } finally {
        }
    }

}