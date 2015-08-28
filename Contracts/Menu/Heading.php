<?php

namespace Vitlabs\GUICore\Contracts\Menu;

use Closure;

interface Heading
{

    public function __construct($title = '');

    // Get or set
    public function title($title = null);

    // Get or set
    public function attr($attribute, $value = null);

}