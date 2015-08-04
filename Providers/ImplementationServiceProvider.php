<?php

namespace Vitlabs\GUICore\Providers;

use Illuminate\Support\ServiceProvider;

abstract class ImplementationServiceProvider extends ServiceProvider
{
    protected $viewsPath = null;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register translation paths
        foreach ($this->loadTranslations() as $dir => $hint)
        {
            $this->loadTranslationsFrom($dir, $hint);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Get generator
        $generator = $this->app->make('Vitlabs\GUICore\Contracts\Generator');

        // Register elements
        foreach ($this->bindElements as $element)
        {
            $generator->registerElement($element, $this->contractsNamespace, $this->implementationsNamespace);
        }

        // Register view path
        $viewPath = $this->getViewPath();

        if ($viewPath != null)
        {
            $this->loadViewsFrom($viewPath, config('gui-core.viewsHint'));
        }

        // Publish assets
        $assetsPath = $this->getAssetsPath();

        if ($assetsPath != null)
        {
            $this->publishes([
                $assetsPath => config('gui-core.assetsBackendPath'),
            ], config('gui-core.publishesTag'));
        }

        // Publish config files
        foreach ($this->publishConfig() as $file => $config)
        {
            $this->publishes([
                $file => config_path($config . '.php'),
            ]);
            $this->mergeConfigFrom(
                $file, $config
            );
        }
    }

    protected function getViewPath()
    {
        return null;
    }

    protected function getAssetsPath()
    {
        return null;
    }

    protected function publishConfig()
    {
        return [];
    }

    protected function loadTranslations()
    {
        return [];
    }

}
