<?php

namespace Vitlabs\GUICore\Contracts\Menu;

use Closure;

interface Heading
{

    function __construct($title = '');

    // Get or set
    function title($title = null);

    // Get or set
    function attr($attribute, $value = null);

}