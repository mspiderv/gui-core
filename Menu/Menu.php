<?php

namespace Vitlabs\GUICore\Menu;

use Vitlabs\GUICore\Contracts\Menu\Menu;
use Vitlabs\GUICore\Menu\Heading;
use Vitlabs\GUICore\Menu\Item;

class Menu implements Menu
{

    protected $items = [];

    public function heading($title = '')
    {
        $this->items[] = new Heading($title);

        return $this;
    }

    public function link($title = '', $href = '', $icon = '', Closure $closure = null)
    {
        $this->items[] = new Item($title, $href, $icon, $closure);

        return $this;
    }

    public function getItems()
    {
        return $this->items;
    }

}
