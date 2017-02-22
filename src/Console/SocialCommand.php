<?php

namespace Acacha\AdminLTETemplateLaravel\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SocialCommand.
 */
class SocialCommand extends BaseCommand
{
    /**
     * Initialize command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        if ($input->hasOption('dev')) {
            $this->installDev = $input->getOption('dev');
        }
    }

    /**
     * Configure the command options.
     */
    protected function configure()
    {
        $this->ignoreValidationErrors();

        $this->setName('social')
            ->setDescription('Add OAuth social login/register support using Socialiate into the current project.');
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
        $llum = $this->findLlum();
        $package = $this->getPackageName();
        $output->writeln('<info>'.$llum.' package '.$this->getDevOption()."$package".'</info>');
        passthru($llum.' package '.$this->getDevOption().' '.$package);
    }

    /**
     * Get llum package name.
     */
    protected function getPackageName()
    {
        return 'laravel-social';
    }
}
