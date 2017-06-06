<?php

namespace Easel\Extensions;

use Easel\Foundation\AbstractServiceProvider;

class ExtensionsServiceProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->bind('canvas.extensions', 'Easel\Extensions\ExtensionManager');

        $bootstrappers = $this->app->make('canvas.extensions')->getEnabledBootstrappers();

        foreach ($bootstrappers as $file) {
            $bootstrapper = require $file;

            $this->app->call($bootstrapper);
        }
    }
}
