<?php

namespace Vitlabs\GUICore\Contracts\Components;

interface AttributesElement {

	/**
	 * Kombinuje getter getAttribute a setter setAttribute.
	 */
    function attr($attribute, $value = null);

    function setAttribute($attribute, $value);

    function setAttributes(array $attributes = []);

    function appendAttribute($attribute, $appendValue, & $attributes = null);

    function getAttribute($attribute);

    function removeAttribute($attribute);

    function hasAttribute($attribute, & $attributes = null);

    function getAttributes();

    function parseAttributes($withSpace = true, & $attributes = null);

    function addClass($class, & $attributes = null);

    function removeClass($class);

    function getOrSetAttribute($variable, $value = null);

}
