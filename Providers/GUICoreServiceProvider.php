<?php

namespace Vitlabs\GUICore\Providers;

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
        // Load config
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('gui-core.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php', 'gui-core'
        );

        // Bind BasicElement implementation
        $this->app->bind('Vitlabs\GUICore\Contracts\Elements\BasicElementContract', 'Vitlabs\GUICore\Elements\BasicElement');

        // Bind generator implementation
        $this->app->bind('Vitlabs\GUICore\Contracts\Generator', config('gui-core.generatorImplementation'), true);

        // Bind menu implementations
        $this->app->bind('Vitlabs\GUICore\Contracts\Menu\HeadingContract', 'Vitlabs\GUICore\Menu\Heading');
        $this->app->bind('Vitlabs\GUICore\Contracts\Menu\LinkContract', 'Vitlabs\GUICore\Menu\Link');
        $this->app->bind('Vitlabs\GUICore\Contracts\Menu\MenuContract', 'Vitlabs\GUICore\Menu\Menu');
    }
}
