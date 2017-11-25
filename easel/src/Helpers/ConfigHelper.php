<?php

namespace Easel\Helpers;

use ConfigWriter;

class ConfigHelper extends \App\Helpers\CanvasHelper
{
    // Config
    const FILENAME = 'blog.php';

    /**
     * Get config writer instance.
     */
    public static function getWriter()
    {
        return new ConfigWriter(basename(self::FILENAME, '.php'));
    }
}
