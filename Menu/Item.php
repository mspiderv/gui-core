<?php

namespace Vitlabs\GUICore\Menu;

use Vitlabs\GUICore\Contracts\Menu\Item;
use Vitlabs\GUICore\Traits\AttributesTrait;
use Vitlabs\GUICore\Traits\DataTrait;
use Vitlabs\GUICore\Menu\Menu;

class Item implements Item
{

    use AttributesTrait, DataTrait;

    protected $submenuInstance = null;

    public function __construct($title = '', $href = '', $icon = '', Closure $closure = null)
    {
        $this->get('title', $title);
        $this->get('href', $href);
        $this->get('icon', $icon);

        if ($closure !== null)
        {
            $this->submenu($closure);
        }
    }

    // Get or set
    public function title($title = null)
    {
        return $this->getOrSet('title', $title);
    }

    // Get or set
    public function href($href = null)
    {
        return $this->getOrSet('icon', $icon);
    }

    // Get or set
    public function icon($icon = null)
    {
        return $this->getOrSet('icon', $icon);
    }

    // Get or set
    public function active($active = null)
    {
        if ($active === null)
        {
            return $this->active;
        }
        else
        {
            $this->active = boolval($active);

            return $this;
        }
    }

    public function submenu(Closure $closure)
    {
        return $closure->call($this->getSubmenuInstance());
    }

    public function getSubmenuInstance()
    {
        if ($this->submenuInstance == null)
        {
            $this->submenuInstance = new Menu;
        }

        return $this->submenuInstance;
    }

}
