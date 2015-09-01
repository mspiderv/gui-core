<?php

namespace Vitlabs\GUICore\Contracts;

use Illuminate\Contracts\Foundation\Application;

interface GeneratorContract {

	function __construct(Application $app);

	function getResourceBag();

	function registerElement($element, $contractNamespace, $implementationNamespace);

	function getElementContract($element);

	function isElementRegistered($element);

	function makeClassName($element);

	function makeElementKey($element);

	function makeViewName($element);

    function generate($elementName, array $args = []);

}