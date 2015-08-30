<?php

namespace Vitlabs\GUICore\Contracts\Menu;

use Closure;
use Countable;

interface MenuContract extends Countable
{

    // Return DividerContract object
    function divider();

    // Return HeadingContract object
    function heading($title = '');

    // Return LinkContract object
    function link($title = '', $href = '', $icon = '', Closure $closure = null);

    function getItems();

}