<?php

namespace Acacha\AdminLTETemplateLaravel\Console;

use Acacha\AdminLTETemplateLaravel\Console\Traits\Paths;
use Symfony\Component\Console\Command\Command;

/**
 * Class BaseCommand.
 */
class BaseCommand extends Command
{
    use Paths;

    /**
     * Install development version.
     *
     * @var bool
     */
    protected $installDev = false;

    /**
     * Get the llum command for the environment.
     *
     * @return string
     */
    protected function findLlum()
    {
        $HOME = $this->getUserHomePath();
        if (is_executable($this->getRealPath("$HOME/.composer/vendor/bin/llum"))) {
            return "$HOME/.composer/vendor/bin/llum";
        }
        if (is_executable($this->getRealPath("$HOME/.config/composer/vendor/bin/llum"))) {
            return "$HOME/.config/composer/vendor/bin/llum";
        }

        return 'llum';
    }

    /**
     * Gets dev option.
     *
     * @return string
     */
    protected function getDevOption()
    {
        return $this->installDev ? '--dev' : '';
    }
}
