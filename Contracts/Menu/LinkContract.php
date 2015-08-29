<?php

namespace Vitlabs\GUICore\Contracts\Menu;

use Closure;

interface LinkContract
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

    // Set active to true
    function cur();

    function hasSubmenu();

    // Get or set
    function attr($attribute, $value = null);

    function submenu(Closure $closure);

    // Return MenuContract object
    function getSubmenuInstance();

}