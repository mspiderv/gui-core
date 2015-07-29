<?php

namespace Vitlabs\GUICore\Contracts\Components;

interface DataElement {

	public function setMany(array $data);

	public function set($variable, $value);

	public function __set($variable, $value);

	public function getMany(array $variables);

	public function get($variable);

	public function __get($variable);

	public function getData();

	public function has($variable);

	public function setOptionals(array $variables);

	public function setOptional($variable);

	public function setDefault($variable, $value);

	public function getOrSet($variable, $value = null);

}
