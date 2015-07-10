<?php

namespace Desk\Core\Commands\Config;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuildCommand extends Command
{


    protected function configure()
    {
        $this->setName('config:build')
            ->setDescription('Creates .env file with all env var from config');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = '';
        $rootPath = app_path();
        $envFileName = $rootPath . '.env';
        try {
            $envFiles = glob($rootPath . 'config/*.env', GLOB_NOSORT);
            foreach ($envFiles as $file) {
                ;
                $result .= '# ' . preg_replace('/(\/.+\/)*(.+)\.(.*)$/', '$2', $file) . "\n";
                $result .= file_get_contents($file);
                $result .= "\n\n";
            }
            file_put_contents($envFileName, $result);
            $output->writeln('Done!');
        } catch (\Exception $ex) {
            $output->writeln('Something gonna wrong: ' . $ex->getMessage());
        }
    }
}
