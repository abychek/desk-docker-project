<?php

namespace Desk\Core\Commands\Config;

use Desk\Core\Services\Config\EnvironmentConfigReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GetCommand extends Command
{
    protected function configure()
    {
        $this->setName('config:get')
            ->setDescription('Get property from environment name')
            ->addArgument(
                'environment',
                InputArgument::OPTIONAL,
                'What environment you search ?'
            )->addOption(
                'yell',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will yell in uppercase letters'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $environment = $input->getArgument('environment');
        $environmentConfigReader = new EnvironmentConfigReader();
        $output->writeln($environmentConfigReader->get($environment));
    }
}