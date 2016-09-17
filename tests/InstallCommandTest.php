<?php

namespace Acacha\AdminLTETemplateLaravel\Tests;

use Acacha\AdminLTETemplateLaravel\Console\InstallCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class InstallCommandTest.
 */
class InstallCommandTest extends \PHPUnit_Framework_TestCase
{
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
            'command' => $command->getName(),
        ]);

        $this->assertTrue(
            $this->fileHasContent('/composer.json', 'acacha/admin-lte-template-laravel'));

        $this->assertTrue(
            $this->fileHasContent(
                '/config/app.php',
                'Acacha\AdminLTETemplateLaravel\Providers\AdminLTETemplateServiceProvider::class'
            ));

        $this->assertTrue(
            $this->fileHasContent(
                '/config/app.php',
                'Acacha\AdminLTETemplateLaravel\Facades\AdminLTE::class'
            ));

        $this->assertFileExists('app/Http/Controllers/HomeController.php');

        $this->assertTrue(
            $this->fileHasContent(
                '/app/Http/Controllers/Auth/RegisterController.php',
                "'terms' => 'required',"
            ));

        $this->assertFileExists('public/img');
        $this->assertFileExists('public/img/AcachaAdminLTE.png');
        $this->assertFileExists('public/css/AdminLTE.css');
        $this->assertFileExists('public/js/adminlte-app.js');
        $this->assertFileExists('public/plugins');
        $this->assertFileExists('public/fonts');
        $this->assertFileExists('resources/views/auth');
        $this->assertFileExists('resources/views/auth/emails');
        $this->assertFileExists('resources/views/errors/404.blade.php');
        $this->assertFileExists('resources/views/layouts');
        $this->assertFileExists('resources/views/home.blade.php');
        $this->assertTrue(
            $this->fileHasContent(
                '/resources/views/welcome.blade.php',
                "extends('layouts.landing')"
            ));
        $this->assertFileExists('resources/assets/less');
        $this->assertTrue(
            $this->fileHasContent(
                '/gulpfile.js',
                "mix.less('admin-lte/AdminLTE.less');"
            ));
        $this->assertFileExists('tests/AcachaAdminLTELaravelTest.php');
        $this->assertTrue(
            $this->fileHasContent(
                '/phpunit.xml',
                'sqlite'
            ));
        $this->assertFileExists('resources/lang/vendor/adminlte_lang');
        $this->assertFileExists('config/gravatar.php');
    }

    /**
     * Test if file has content.
     *
     * @param $file
     * @param $content
     *
     * @return bool
     */
    private function fileHasContent($file, $content)
    {
        return strpos(file_get_contents(getcwd().$file), $content) != false;
    }
}
