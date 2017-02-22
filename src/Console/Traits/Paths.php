<?php

namespace Acacha\AdminLTETemplateLaravel\Console\Traits;

/**
 * Class Paths.
 */
trait Paths
{
    /**
     * Get the real path of a link or regular path if file is not a link.
     *
     * @param $file
     *
     * @return string
     */
    private function getRealPath($file)
    {
        if (is_link($file)) {
            return realpath($file);
        }

        return $file;
    }

    /**
     * Get user home path.
     *
     * @return string
     */
    public function getUserHomePath()
    {
        if (isset($_SERVER['HOME'])) {
            return $_SERVER['HOME'];
        }

        if (PHP_OS == 'WINNT') {
            return getenv('USERPROFILE');
        } else {
            return getenv('HOME');
        }
    }
}
