<?php

namespace Vitlabs\GUICore\Contracts\Elements;

use Vitlabs\GUICore\Contracts\Components\DataElement;

interface BasicElementContract extends ElementContract, DataElement {

	function setView($view);

	function getView();


}