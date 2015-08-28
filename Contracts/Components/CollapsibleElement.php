<?php

namespace Vitlabs\GUICore\Contracts\Components;

interface CollapsibleElement {

	function getCollapsibleId();

    function getTitle();

    function getContent();

    function getState();

}
