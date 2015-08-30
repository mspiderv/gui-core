<?php

namespace Vitlabs\GUICore\Contracts\Menu;

use Closure;
use Vitlabs\GUICore\Contracts\Components\AttributesElement;

interface LinkContract extends AttributesElement
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

    function sub(Closure $closure);

    // Return MenuContract object
    function getSubmenuInstance();

}