<?php

namespace Vitlabs\GUICore\Contracts\Elements;

use Vitlabs\GUICore\Contracts\GeneratorContract;
use Vitlabs\GUICore\Contracts\Components\ContainerElement;

interface ElementContract {

	function postConstruct();

	function setGenerator(GeneratorContract $generator);

	function getGenerator();

	function needResources();

	function to(ContainerElement $element, $position = null);

    function render();

	function getMenu($menu);

	/*
	 * Example: $text->toFooter($box)
	 */
	function __call($method, $args = array());

}