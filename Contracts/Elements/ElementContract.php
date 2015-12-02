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

    function getPackageName();

    /**
     * Get the specified configuration value.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function config($key = null, $default = null);

    /**
     * Translate the given message.
     *
     * @param  string  $id
     * @param  array   $parameters
     * @param  string  $domain
     * @param  string  $locale
     * @return string
     */
    function trans($id = null, $parameters = [], $domain = 'messages', $locale = null);

	/*
	 * Example: $text->toFooter($box)
	 */
	function __call($method, $args = array());

}