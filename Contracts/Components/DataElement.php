<?php

namespace Vitlabs\GUICore\Contracts\Components;

interface DataElement {

	function setMany(array $data);

	function set($variable, $value);

	function __set($variable, $value);

	function getMany(array $variables);

	function get($variable);

	function __get($variable);

	function getData();

	function has($variable);

	function setOptionals(array $variables);

	function setOptional($variable);

	function setDefault($variable, $value);

	function getOrSet($variable, $value = null);

}
