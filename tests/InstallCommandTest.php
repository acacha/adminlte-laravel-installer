<?php

namespace Acacha\AdminLTETemplateLaravel\Tests;

use Acacha\AdminLTETemplateLaravel\Console\InstallCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class InstallCommandTest.
 */
class InstallCommandTest extends TestCase
{
    /** @test */
    public function testInstallCommand()
    {
        $application = new Application();
        $application->add(new InstallCommand());

        $command = $application->find('install');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command' => $command->getName(),
        ]);

        $output = $commandTester->getDisplay();
        $this->assertContains('Running composer require acacha/admin-lte-template-laravel', $output);
        $this->assertContains('php artisan adminlte:publish', $output);
    }

    /** @test */
    public function testInstallDevCommand()
    {
        $application = new Application();
        $application->add(new InstallCommand());

        $command = $application->find('install');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command' => $command->getName(),
            '--dev' => true
        ]);

        $output = $commandTester->getDisplay();
        $this->assertContains('Running composer require acacha/admin-lte-template-laravel:dev-master', $output);
        $this->assertContains('php artisan adminlte:publish', $output);

    }

    /** @test */
    public function testInstallNoAnsiCommand()
    {
        $application = new Application();
        $application->add(new InstallCommand());

        $command = $application->find('install');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command' => $command->getName(),
            '--no-ansi' => true
        ]);

        $output = $commandTester->getDisplay();
        $this->assertContains('--no-ansi', $output);

    }

    /** @test */
    public function testInstallUseVendorPublishCommand()
    {
        $application = new Application();
        $application->add(new InstallCommand());

        $command = $application->find('install');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command' => $command->getName(),
            '--use-vendor-publish' => true
        ]);

        $output = $commandTester->getDisplay();
        $this->assertContains('Running composer require acacha/admin-lte-template-laravel', $output);
        $this->assertContains('php artisan vendor:publish --tag=adminlte --force', $output);

    }
}
