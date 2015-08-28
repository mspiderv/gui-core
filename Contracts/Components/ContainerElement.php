<?php

namespace Vitlabs\GUICore\Contracts\Components;

use Vitlabs\GUICore\Contracts\Elements\ElementContract;

interface ContainerElement {

    function add(ElementContract $e, $position = null);

    function getAllElements();

    function getPositionElements($position = null);

    function removeElements();

    function removePositionElements($position = null);

    function getPositions();

    function renderElements(array $elements);

    function getDefaultPositionName();

}
