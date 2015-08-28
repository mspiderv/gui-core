<?php

namespace Vitlabs\GUICore\Contracts\Menu;

use Closure;

interface Item
{

    public function __construct($title = '', $href = '', $icon = '', Closure $closure = null);

    // Get or set
    public function title($title = null);

    // Get or set
    public function href($href = null);

    // Get or set
    public function icon($icon = null);

    // Get or set
    public function active($active = null);

    // Get or set
    public function attr($attribute, $value = null);

    public function submenu(Closure $closure);

    public function getSubmenuInstance();

}