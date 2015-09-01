<?php

namespace Vitlabs\GUICore\Contracts\Components;

interface FieldContract {

    // Constructor
    function __construct();

    // Get or set
    function name($name);
    function value($value);
    function id($id);
    function disabled($disabled = null);

    // Getters
    function getEscapedValue();

    // Set "disabled" to true
    function disable();

    // Set "disabled" to false
    function enable();

    // Render methods
    function renderField();

}