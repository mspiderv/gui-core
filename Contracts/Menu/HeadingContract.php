<?php

namespace Vitlabs\GUICore\Contracts\Menu;

interface HeadingContract
{

    function __construct($title = '');

    // Get or set
    function title($title = null);

    // Get or set
    function attr($attribute, $value = null);

}