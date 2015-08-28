<?php

namespace Vitlabs\GUICore\Contracts\Menu;

use Closure;

interface Menu
{

    public function heading($title = '');

    public function link($title = '', $href = '', $icon = '', Closure $closure = null);

    public function getItems();

}