<?php

namespace Vitlabs\GUICore\Contracts;

use Illuminate\Contracts\Foundation\Application;

interface GeneratorContract {

	public function __construct(Application $app);

	public function getResourceBag();

	public function registerElement($element, $contractNamespace, $implementationNamespace);

	public function getElementContract($element);

	public function isElementRegistered($element);

	public function makeClassName($element);

	public function makeElementKey($element);

	public function makeViewName($element);

}