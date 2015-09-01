<?php

namespace Vitlabs\GUICore;

class ResourceBag {

    protected $js = [];
    protected $css = [];
    protected $config = [];
    protected $variables = [];
    protected $url = null;

    public function __construct()
    {
        $this->url = app('url');
    }

    public function add(array $resources, $pathPrefix = '')
    {
        // JS
        if (isset($resources['js']))
        {
            foreach ($resources['js'] as $js) $this->addJS($js, 'after', $pathPrefix);
        }

        if (isset($resources['js-before']))
        {
            foreach ($resources['js-before'] as $js) $this->addJS($js, 'before', $pathPrefix);
        }

        // CSS
        if (isset($resources['css']))
        {
            foreach ($resources['css'] as $css) $this->addCSS($css, 'after', $pathPrefix);
        }

        if (isset($resources['css-before']))
        {
            foreach ($resources['css-before'] as $css) $this->addCSS($css, 'before', $pathPrefix);
        }

        // Config
        if (isset($resources['config']))
        {
            foreach ($resources['config'] as $configLine => $key) $this->addConfig($configLine, $key);
        }

        // Variables
        if (isset($resources['variables']))
        {
            foreach ($resources['variables'] as $variable => $value) $this->addVariable($variable, $value);
        }

        return $this;
    }

    public function addJS($path, $place = 'after', $pathPrefix = '')
    {
        $path = $this->parsePath($path, $pathPrefix);

        if ($this->hasJS($path))
        {
            return $this;
        }

        if ($place == 'after')
        {
            $this->js[] = $path;
        }

        elseif ($place == 'before')
        {
            array_unshift($this->js, $path);
        }

        return $this;
    }

    public function addCSS($path, $place = 'after', $pathPrefix = '')
    {
        $path = $this->parsePath($path, $pathPrefix);

        if ($this->hasCSS($path))
        {
            return $this;
        }

        if ($place == 'after')
        {
            $this->css[] = $path;
        }

        elseif ($place == 'before')
        {
            array_unshift($this->css, $path);
        }

        return $this;
    }

    public function addConfig($configLine, $key)
    {
        $this->config[$key] = config($configLine);

        return $this;
    }

    public function addVariable($variable, $value)
    {
        $this->variables[$variable] = $value;

        return $this;
    }

    public function removeJS($path, $pathPrefix = '')
    {
        $path = $this->parsePath($path, $pathPrefix);

        if (($key = array_search($path, $this->js)) !== false) {
            unset($this->js[$key]);
        }

        return $this;
    }

    public function removeCSS($path, $pathPrefix = '')
    {
        $path = $this->parsePath($path, $pathPrefix);

        if (($key = array_search($path, $this->css)) !== false) {
            unset($this->css[$key]);
        }

        return $this;
    }

    public function removeConfig($key)
    {
        if (isset($this->config[$key]))
        {
            unset($this->config[$key]);
        }

        return $this;
    }

    public function removeVariable($variable)
    {
        if (isset($this->variables[$variable]))
        {
            unset($this->variables[$variable]);
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
            $result .= '<link rel="stylesheet" type="text/css" href="' . $css . '" />' . PHP_EOL;
        }

        return $result;
    }

    public function getParsedJS()
    {
        $result = '';

        foreach ($this->js as $js)
        {
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
        return json_encode($this->config);
    }

    public function getParsedConfig()
    {
        return '<script>window.cfg=' . $this->getJSONConfig() . ';</script>';
    }

    public function getVariables()
    {
        return $this->variables;
    }

    public function getJSONVariables()
    {
        return json_encode($this->variables);
    }

    public function getParsedVariables()
    {
        return '<script>window.variables=' . $this->getJSONVariables() . ';</script>';
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

    public function hasVariable($variable)
    {
        return (isset($this->variables[$variable]));
    }

    public function getAll()
    {
        return [
            'css' => $this->css,
            'js' => $this->js,
            'config' => $this->config,
            'JSONConfig' => $this->getJSONConfig(),
            'variables' => $this->getJSONVariables()
        ];
    }

    protected function isPathAbsolute($path)
    {
        return $this->url->isValidUrl($path);
    }

    protected function parsePath($path, $pathPrefix = '')
    {
        if ($this->isPathAbsolute($path))
        {
            return $path;
        }

        else
        {
            if (substr($path, 0, 1) == '~')
            {
                return asset($pathPrefix . substr($path, 1));
            }

            else
            {
                return asset($path);
            }
        }
    }

}
