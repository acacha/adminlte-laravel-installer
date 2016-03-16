<?php

namespace Acacha\AdminLTETemplateLaravel\Console;

use Symfony\Component\Process\Process;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class InstallCommand
 * @package Acacha\AdminLTETemplateLaravel\Console
 */
class InstallCommand extends Command
{

    /**
     * Avoids using llum to install package.
     *
     * @var bool
     */
    protected $noLlum = false;

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);
        if ($input->hasOption('no-llum')) {
            $this->noLlum = $input->getOption('no-llum');
        }
    }

    /**
     * Check is --no-llum option is active.
     *
     * @return bool
     */
    private function isNoLlumActive()
    {
        return $this->noLlum;
    }

    /**
     * Configure the command options.
     */
    protected function configure()
    {
        $this->ignoreValidationErrors();

        $this->setName('install')
                ->setDescription('Install Acacha AdminLTE package into the current project.');
    }

    /**
     * Execute the command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->isNoLlumActive()) {
            $this->executeWithoutLlum($output);
        } else {
            passthru(__DIR__ . "/../../vendor/acacha/llum/llum package AdminLTE");
        }
    }

    /**
     * Execute command wiht option --no-llum
     *
     * @param OutputInterface $output
     */
    protected function executeWithoutLlum(OutputInterface $output)
    {
        $composer = $this->findComposer();

        $process = new Process($composer.' require acacha/admin-lte-template-laravel', null, null, null, null);

        $process->run(function ($type, $line) use ($output) {
            $output->write($line);
        });

        copy(__DIR__.'/stubs/app.php', getcwd().'/config/app.php');

        passthru('php artisan vendor:publish --tag=adminlte --force');
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    private function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" composer.phar"';
        }

        return 'composer';
    }
}
