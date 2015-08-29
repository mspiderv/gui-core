<?php

namespace Vitlabs\GUICore\Menu;

use Closure;
use Vitlabs\GUICore\Contracts\Menu\MenuContract;
use Vitlabs\GUICore\Menu\Heading;
use Vitlabs\GUICore\Menu\Item;

class Menu implements MenuContract
{

    protected $items = [];

    public function heading($title = '')
    {
        $heading = new Heading($title);

        $this->items[] = $heading;

        return $heading;
    }

    public function link($title = '', $href = '', $icon = '', Closure $closure = null)
    {
        $link = new Link($title, $href, $icon, $closure);

        $this->items[] = $link;

        return $link;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function count()
    {
        return count($this->items);
    }

}
