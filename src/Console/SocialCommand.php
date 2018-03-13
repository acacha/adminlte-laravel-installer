<?php

namespace Acacha\AdminLTETemplateLaravel\Console;

use Acacha\AdminLTETemplateLaravel\Console\Traits\UseComposer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

/**
 * Class SocialCommand.
 */
class SocialCommand extends Command
{
    use UseComposer;

    /**
     * Get package name to install.
     */
    protected function getPackageName()
    {
        return 'acacha/laravel-social';
    }

    /**
     * Configure the command options.
     */
    protected function configure()
    {
        $this->ignoreValidationErrors();

        $this->setName('social')
            ->setDescription('Add Acacha Laravel Social Package: OAuth Social Login/Register support using Socialite into the current project.')
            ->addOption(
                'dev',
                '-d',
                InputOption::VALUE_NONE,
                'Installs the latest "development" release'
            );
    }

    /**
     * Execute the command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $process = new Process(
            $this->findComposer().' require '.$package = $this->getPackageName().$this->getDevSuffix($input),
            null,
            null,
            null,
            null
        );

        $output->writeln('<info>Running composer require '.$package.'</info>');
        $process->run(function ($type, $line) use ($output) {
            $output->write($line);
        });

        $this->runMakeSocial($output);
    }

    /**
     * Gets dev suffix.
     *
     * @param InputInterface $input
     *
     * @return string
     */
    private function getDevSuffix(InputInterface $input)
    {
        return $input->getOption('dev') ? ':dev-master' : '';
    }

    /**
     * Run make social.
     *
     * @param OutputInterface $output
     */
    protected function runMakeSocial(OutputInterface $output)
    {
        $output->writeln('<info>php artisan make:social</info>');
        passthru('php artisan make:social');
    }
}
