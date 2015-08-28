<?php

namespace Vitlabs\GUICore\Contracts\Menu;

use Closure;

interface Item
{

    function __construct($title = '', $href = '', $icon = '', Closure $closure = null);

    // Get or set
    function title($title = null);

    // Get or set
    function href($href = null);

    // Get or set
    function icon($icon = null);

    // Get or set
    function active($active = null);

    // Get or set
    function attr($attribute, $value = null);

    function submenu(Closure $closure);

    function getSubmenuInstance();

}