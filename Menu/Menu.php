<?php

namespace Vitlabs\GUICore\Menu;

use Closure;
use Vitlabs\GUICore\Contracts\Menu\MenuContract;

class Menu implements MenuContract
{

    protected $items = [];

    public function divider()
    {
        $divider = app('Vitlabs\GUICore\Contracts\Menu\DividerContract');

        $this->items[] = $divider;

        return $divider;
    }

    public function heading($title = '')
    {
        $heading = app('Vitlabs\GUICore\Contracts\Menu\HeadingContract', [$title]);

        $this->items[] = $heading;

        return $heading;
    }

    public function link($title = '', $href = '', $icon = '', Closure $closure = null)
    {
        $link = app('Vitlabs\GUICore\Contracts\Menu\LinkContract', [$title, $href, $icon, $closure]);

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
