<?php

namespace Vitlabs\GUICore;

class ResourceBag {

    protected $js = [];
    protected $css = [];
    protected $config = [];
    protected $assetsPath;

    public function __construct($assetsPath)
    {
        $this->assetsPath = $assetsPath;
    }

    public function setAssetsPath($assetsPath)
    {
        $this->assetsPath = $assetsPath;

        return $this;
    }

    public function getAssetsPath()
    {
        return $this->assetsPath;
    }

    public function add(array $resources)
    {
        // JS
        if (isset($resources['js']))
        {
            $this->js = array_unique(array_merge($this->js, $resources['js']));
        }

        if (isset($resources['js-before']))
        {
            $this->js = array_unique(array_merge($resources['js-before'], $this->js));
        }

        // CSS
        if (isset($resources['css']))
        {
            $this->css = array_unique(array_merge($this->css, $resources['css']));
        }

        if (isset($resources['css-before']))
        {
            $this->css = array_unique(array_merge($resources['css-before'], $this->css));
        }

        // Config
        if (isset($resources['config']))
        {
            $this->config = array_unique(array_merge($this->config, $resources['config']));
        }

        return $this;
    }

    public function addJS($path)
    {
        if ( ! $this->hasJS($path))
        {
            $this->js[] = $path;
        }

        return $this;
    }

    public function addCSS($path)
    {
        if ( ! $this->hasCSS($path))
        {
            $this->css[] = $path;
        }

        return $this;
    }

    public function addConfig($configKey)
    {
        if ( ! $this->hasConfig($configKey))
        {
            $this->config[] = $configKey;
        }

        return $this;
    }

    public function removeJS($path)
    {
        if (($key = array_search($path, $this->js)) !== false) {
            unset($this->js[$key]);
        }

        return $this;
    }

    public function removeCSS($path)
    {
        if (($key = array_search($path, $this->css)) !== false) {
            unset($this->css[$key]);
        }

        return $this;
    }

    public function removeConfig($configKey)
    {
        if (($key = array_search($configKey, $this->config)) !== false) {
            unset($this->config[$key]);
        }

        return $this;
    }

    public function getJS()
    {
        return $this->js;
    }

    public function getParsedCSS()
    {
        $result = '';

        foreach ($this->css as $css)
        {
            if ($this->isPathRelative($css))
            {
                $css = $this->assetsPath . $css;
            }

            $result .= '<link rel="stylesheet" type="text/css" href="' . $css . '" />' . PHP_EOL;
        }

        return $result;
    }

    public function getParsedJS()
    {
        $result = '';

        foreach ($this->js as $js)
        {
            if ( ! $this->isPathAbsolute($js))
            {
                $js = $this->assetsPath . $js;
            }

            $result .= '<script src="' . $js . '" type="text/javascript"></script>' . PHP_EOL;
        }

        return $result;
    }

    public function getCSS()
    {
        return $this->css;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getJSONConfig()
    {
        $result = [];

        foreach ($this->config as $key)
        {
            $result[$key] = config($key);
        }

        return json_encode($result);
    }

    public function getParsedConfig()
    {
        return '<script>window.cfg=' . $this->getJSONConfig() . ';</script>';
    }

    public function hasJS($path)
    {
        return array_search($path, $this->js) !== false;
    }

    public function hasCSS($path)
    {
        return array_search($path, $this->css) !== false;
    }

    public function hasConfig($configKey)
    {
        return array_search($configKey, $this->config) !== false;
    }

    public function getAll()
    {
        return [
            'css' => $this->css,
            'js' => $this->js,
            'config' => $this->config,
            'JSONConfig' => $this->getJSONConfig()
        ];
    }

    public function isPathAbsolute($path)
    {
        return (substr($path, 0, 7) == 'http://' || substr($path, 0, 8) == 'https://' || substr($path, 0, 7) == 'file://');
    }

    public function isPathRelative($path)
    {
        return (! $this->isPathAbsolute($path));
    }

}
