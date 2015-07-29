<?php

namespace Vitlabs\GUICore\Contracts\Components;

interface CollapsibleElement {

	public function getCollapsibleId();

    public function getTitle();

    public function getContent();

    public function getState();

}
