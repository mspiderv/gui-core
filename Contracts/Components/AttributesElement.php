<?php

namespace Vitlabs\GUICore\Contracts\Components;

interface AttributesElement {

	/**
	 * Kombinuje getter getAttribute a setter setAttribute.
	 */
    public function attr($attribute, $value = null);

    public function setAttribute($attribute, $value);

    public function appendAttribute($attribute, $appendValue, & $attributes = null);

    public function getAttribute($attribute);

    public function removeAttribute($attribute);

    public function hasAttribute($attribute, & $attributes = null);

    public function getAttributes();

    public function parseAttributes($withSpace = true, & $attributes = null);

    public function addClass($class, & $attributes = null);

    public function removeClass($class);

    public function getOrSetAttribute($variable, $value = null);

}
