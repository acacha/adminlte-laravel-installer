<?php

namespace Acacha\AdminLTETemplateLaravel;

use Acacha\AdminLTETemplateLaravel\Console\InstallCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class InstallCommandTest.
 */
class InstallCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Set up tests.
     */
    protected function setUpBefore()
    {
        passthru('./sandbox_setup.sh');
    }

    /**
     * Tear down tests.
     */
    protected function tearDown()
    {
        passthru('./sandbox_destroy.sh');
    }

    /**
     * Test execution.
     */
    public function testExecute()
    {
        $application = new Application();
        $application->add(new InstallCommand());

        $command = $application->find('install');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName()
        ]);

//        $this->assertFileExists('config/app.php');
        $this->assertTrue(false);
//
//            $this->laravelConfigFileHasContent('#llum_providers')
//        );
//        $this->assertTrue(
//            $this->laravelConfigFileHasContent('#llum_aliases')
//        );
//        $this->assertTrue(
//            $this->laravelConfigFileHasContent('Acacha\AdminLTETemplateLaravel\app\Providers\AdminLTETemplateServiceProvider::class')
//        );
    }
}