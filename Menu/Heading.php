<?php

namespace Vitlabs\GUICore\Menu;

use Vitlabs\GUICore\Contracts\Menu\Heading;
use Vitlabs\GUICore\Traits\AttributesTrait;

class Heading implements Heading
{

    use AttributesTrait;

    protected $title;

    public function __construct($title = '')
    {
        $this->title = $title;
    }

    // Get or set
    public function title($title = null)
    {
        if ($title === null)
        {
            return $this->title;
        }
        else
        {
            $this->title = $title;

            return $this;
        }
    }

}
