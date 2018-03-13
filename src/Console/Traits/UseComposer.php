<?php

namespace Acacha\AdminLTETemplateLaravel\Console\Traits;

/**
 * Trait UseComposer.
 *
 * @package Acacha\AdminLTETemplateLaravel\Console\Traits
 */
trait UseComposer
{
    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" composer.phar"';
        }

        return 'composer';
    }
}
