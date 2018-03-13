<?php

namespace Acacha\AdminLTETemplateLaravel\Console;

use Acacha\AdminLTETemplateLaravel\Console\Traits\UseComposer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

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
                'dontforce',
                '-F',
                InputOption::VALUE_NONE,
                'Do not force overwrite of files during publish'
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
        $composer = $this->findComposer();

        $commands = [
            $composer.' require '.$this->getPackageName().$this->getDevSuffix($input),
            $composer.' require --dev laravel/dusk',
        ];

        if ($input->getOption('no-ansi')) {
            $commands = array_map(function ($value) {
                return $value.' --no-ansi';
            }, $commands);
        }

        $force = $input->getOption('dontforce') ? '' : ' --force';
        $commands = array_merge($commands, [
            'php artisan dusk:install',
            'php artisan adminlte:publish'.$force,
        ]);

        $process = new Process(
            $runningCommand = implode(' && ', $commands),
            null,
            null,
            null,
            null
        );

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            $process->setTty(true);
        }

        $output->writeln('<info>Running '.$runningCommand.'</info>');
        $process->run(function ($type, $line) use ($output) {
            $output->write($line);
        });
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
}
