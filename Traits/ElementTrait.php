<?php

namespace Vitlabs\GUICore\Traits;

use View;
use Vitlabs\GUICore\Contracts\GeneratorContract;
use Vitlabs\GUICore\Contracts\Components\ContainerElement;

trait ElementTrait {

    protected $generator;
    protected $menus = [];

    public function postConstruct()
    {
        //
    }

    public function setGenerator(GeneratorContract $generator)
    {
        $this->generator = $generator;

        return $this;
    }

    public function getGenerator()
    {
        return $this->generator;
    }

    public function needResources()
    {
        return [];
    }

    public function renderView($view, array $data)
    {
        return View::make(config('gui-core.viewsHint') . '::' . $view, $data)->render();
    }

    public function __toString()
    {
        return (string) $this->render();
    }

    public function to(ContainerElement $element, $position = null)
    {
        $element->add($this, $position);
        return $this;
    }

    public function getMenu($menu)
    {
        if ( ! isset($this->menus[$menu]))
        {
            $this->menus[$menu] = app('Vitlabs\GUICore\Contracts\Menu\MenuContract');
        }

        return $this->menus[$menu];
    }

    /*
     * Example: $text->toFooter($box)
     */
    public function __call($method, $args = array())
    {
        /*
         * ContainerElement $e
         * $x->toPOSITION($e) = $e->to($x, 'POSITION');
         */
        if (substr($method, 0, 2) == 'to' && isset($args[0]))
        {
            return $this->to($args[0], lcfirst(substr($method, 2)));
        }

        return static::__call($method, $args);
    }

}
