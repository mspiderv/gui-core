<?php

namespace Vitlabs\GUICore\Contracts\Elements;

use Vitlabs\GUICore\Contracts\GeneratorContract;
use Vitlabs\GUICore\Contracts\Components\ContainerElement;

interface ElementContract {

	public function postConstruct();

	public function setGenerator(GeneratorContract $generator);

	public function getGenerator();

	public function needResources();

	public function to(ContainerElement $element, $position = null);

    public function render();

	protected function getMenu($menu);

	/*
	 * Example: $text->toFooter($box)
	 */
	public function __call($method, $args = array());

}