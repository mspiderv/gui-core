<?php

namespace Vitlabs\GUICore\Contracts\Elements;

use Vitlabs\GUICore\Contracts\Components\DataElement;

interface BasicElementContract extends ElementContract, DataElement {
	
	public function setView($view);

	public function getView();


}