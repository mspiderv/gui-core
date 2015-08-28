<?php

namespace Vitlabs\GUICore\Contracts\Menu;

use Closure;

interface Menu
{

    function heading($title = '');

    function link($title = '', $href = '', $icon = '', Closure $closure = null);

    function getItems();

}