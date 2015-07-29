<?php

namespace Vitlabs\GUICore\Contracts\Components;

use Vitlabs\GUICore\Contracts\Elements\ElementContract;

interface ContainerElement {

    public function add(ElementContract $e, $position = null);

    public function getAllElements();

    public function getPositionElements($position = null);

    public function removeElements();

    public function removePositionElements($position = null);

    public function getPositions();

    public function renderElements(array $elements);

    public function getDefaultPositionName();

}
