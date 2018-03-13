<?php

namespace Acacha\AdminLTETemplateLaravel\Console;

use Acacha\AdminLTETemplateLaravel\Console\Traits\UseComposer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Command\Command;

/**
 * Class InstallCommand.
 */
class InstallCommand extends Command
{
    use UseComposer;

    /**
     * Get package name to install.
     */
    protected function getPackageName()
    {
        return 'acacha/admin-lte-template-laravel';
    }

    /**
     * Configure the command options.
     */
    protected function configure()
    {
        $this->ignoreValidationErrors();

        $this->setName('install')
            ->setDescription('Install Acacha AdminLTE Laravel package into the current project.')
            ->addOption(
                'dev',
                '-d',
                InputOption::VALUE_NONE,
                'Installs the latest "development" release'
            )
            ->addOption(
                'force',
                '-f',
                InputOption::VALUE_NONE,
                'Forces install even if the directory already exists'
            )
            ->addOption(
                'use-vendor-publish',
                '-p',
                InputOption::VALUE_NONE,
                'Installs using php artisan vendor:publish --tag=adminlte --force . By default php artisan adminlte-laravel:publish is used'
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
        $noansi = '';
        if ($input->getOption('no-ansi')) {
            $noansi = ' --no-ansi';
        }

        $process = new Process(
            $this->findComposer() . ' require ' . $package = $this->getPackageName() . $this->getDevSuffix($input) . $noansi,
            null,
            null,
            null,
            null
        );

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            $process->setTty(true);
        }

        $output->writeln(
            '<info>Running composer require ' . $package .'</info>'
        );
        $process->run(function ($type, $line) use ($output) {
            $output->write($line);
        });

        $input->getOption('use-vendor-publish') ? $this->publishWithVendor($output) : $this->publish($output);
    }

    /**
     * Gets dev suffix.
     *
     * @param InputInterface  $input
     * @return string
     */
    private function getDevSuffix(InputInterface $input)
    {
        return $input->getOption('dev') ? ':dev-master' : '';
    }

    /**
     * Manually publishes files to project.
     *
     * @param OutputInterface $output
     */
    protected function publish(OutputInterface $output)
    {
        $output->writeln('<info>php artisan adminlte:publish</info>');
        passthru('php artisan adminlte-laravel:publish');
    }

    /**
     * Publishes files with artisan publish command.
     *
     * @param OutputInterface $output
     */
    protected function publishWithVendor(OutputInterface $output)
    {
        $output->writeln('<info>php artisan vendor:publish --tag=adminlte --force</info>');
        passthru('php artisan vendor:publish --tag=adminlte --force');
    }
}
