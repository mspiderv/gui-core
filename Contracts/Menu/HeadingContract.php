<?php

namespace Vitlabs\GUICore\Contracts\Menu;

use Vitlabs\GUICore\Contracts\Components\AttributesElement;

interface HeadingContract extends AttributesElement
{

    function __construct($title = '');

    // Get or set
    function title($title = null);

}