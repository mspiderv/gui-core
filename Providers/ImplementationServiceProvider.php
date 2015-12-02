<?php

namespace Vitlabs\GUICore\Providers;

use Illuminate\Support\ServiceProvider;
use Vitlabs\GUICore\Contracts\GeneratorContract;

abstract class ImplementationServiceProvider extends ServiceProvider
{

    protected $contractsNamespace = null;

    protected $implementationsNamespace = null;

    protected $bindElements = null;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Get package name
        $package = $this->getPackageName();

        // Register translation files
        foreach ($this->translationDirs() as $dir)
        {
            // Publish translation files
            $this->publishes([
                $dir => base_path('resources/lang/vendor/' . $package),
            ]);

            // Register translation paths
            $this->loadTranslationsFrom($dir, $package);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Get package name
        $package = $this->getPackageName();

        // Get generator
        $generator = $this->app->make('Vitlabs\GUICore\Contracts\Generator');

        // Try to register elements
        if (is_array($this->bindElements) && $this->contractsNamespace != null && $this->implementationsNamespace != null)
        {
            foreach ($this->bindElements as $element)
            {
                $generator->registerElement($element, $this->contractsNamespace, $this->implementationsNamespace);
            }
        }

        // Register other elements
        $this->registerElements($generator);

        // Register assets
        foreach ($this->assetDirs() as $dir => $target)
        {
            // Target is not set
            if (is_numeric($dir))
            {
                $dir = $target;
                $target = public_path('vendor/' . $package);
            }

            // Target is set
            else
            {
                $target = public_path('vendor/' . $package . '/' . $target);
            }

            // Publish assets
            $this->publishes([
                $dir => $target,
            ], 'public');
        }

        // Register configuration files
        foreach ($this->configFiles() as $file)
        {
            // Publish configuration file
            $this->publishes([
                $file => config_path(basename($file)),
            ], 'config');

            // Merge configuration file
            $this->mergeConfigFrom(
                $file, basename($file, '.php')
            );
        }

        // Register views
        foreach ($this->viewDirs() as $dir)
        {
            // Publish views
            $this->publishes([
                $dir => base_path('resources/views/vendor/' . $package),
            ], 'views');

            // Register view paths
            $this->loadViewsFrom($dir, $package);
        }

    }

    protected function registerElements(GeneratorContract $generator)
    {
        //
    }

    protected function translationDirs()
    {
        return [];
    }

    protected function assetDirs()
    {
        return [];
    }

    protected function configFiles()
    {
        return [];
    }

    protected function viewDirs()
    {
        return [];
    }

    abstract protected function getPackageName();

}
