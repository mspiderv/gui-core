<?php

namespace Vitlabs\GUICore\Menu;

use URL;
use Closure;
use Vitlabs\GUICore\Contracts\Menu\LinkContract;
use Vitlabs\GUICore\Traits\AttributesTrait;
use Vitlabs\GUICore\Traits\DataTrait;

class Link implements LinkContract
{
    use AttributesTrait, DataTrait;

    protected $submenuInstance = null;

    public function __construct($title = '', $href = '', $icon = '', Closure $closure = null)
    {
        $this->set('title', $title);
        $this->set('href', $href);
        $this->set('icon', $icon);
        $this->set('active', false);

        if ( ! is_null($closure))
        {
            $this->sub($closure);
        }

        $this->smartActive();
    }

    protected function smartActive()
    {
        if (URL::current() == $this->get('href'))
        {
            $this->set('active', true);
        }

        return true;
    }

    // Get or set
    public function title($title = null)
    {
        return $this->getOrSet('title', $title);
    }

    // Get or set
    public function href($href = null)
    {
        $result = $this->getOrSet('href', $href);

        $this->smartActive();

        return $result;
    }

    // Get or set
    public function icon($icon = null)
    {
        return $this->getOrSet('icon', $icon);
    }

    // Get or set
    public function active($active = null)
    {
        if (is_null($active))
        {
            return $this->active;
        }
        else
        {
            $this->active = boolval($active);

            return $this;
        }
    }

    // Set active to true
    public function cur()
    {
        $this->active = true;

        return $this;
    }

    public function hasSubmenu()
    {
        return ($this->submenuInstance != null && count($this->getSubmenuInstance()) > 0);
    }

    public function sub(Closure $closure)
    {
        return $closure($this->getSubmenuInstance());
    }

    public function getSubmenuInstance()
    {
        if (is_null($this->submenuInstance))
        {
            $this->submenuInstance = app('Vitlabs\GUICore\Contracts\Menu\MenuContract');
        }

        return $this->submenuInstance;
    }

}
