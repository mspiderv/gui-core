<?php

namespace Vitlabs\GUICore\Providers;

use Exception;
use Illuminate\Support\ServiceProvider;

class GUICoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Publish configuration file
        $this->publishes([
            __DIR__ . '/../Config/gui-core.php' => config_path('gui-core.php'),
        ], 'config');

        // Merge configuration file
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/gui-core.php', 'gui-core'
        );

        // Bind BasicElement implementation
        $this->app->bind('Vitlabs\GUICore\Contracts\Elements\BasicElementContract', 'Vitlabs\GUICore\Elements\BasicElement');

        // Bind generator implementation
        $generatorImplementation = config('gui-core.generatorImplementation');

        if ($generatorImplementation == '')
        {
            throw new Exception('Configuration line [generatorImplementation] in configuration file [gui-core.php] must be set.');
        }

        $this->app->bind('Vitlabs\GUICore\Contracts\Generator', $generatorImplementation, true);

        // Bind menu implementations
        $this->app->bind('Vitlabs\GUICore\Contracts\Menu\DividerContract', 'Vitlabs\GUICore\Menu\Divider');
        $this->app->bind('Vitlabs\GUICore\Contracts\Menu\HeadingContract', 'Vitlabs\GUICore\Menu\Heading');
        $this->app->bind('Vitlabs\GUICore\Contracts\Menu\LinkContract', 'Vitlabs\GUICore\Menu\Link');
        $this->app->bind('Vitlabs\GUICore\Contracts\Menu\MenuContract', 'Vitlabs\GUICore\Menu\Menu');
    }
}
