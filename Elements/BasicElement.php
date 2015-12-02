<?php

namespace Vitlabs\GUICore\Elements;

use Vitlabs\GUICore\Traits\DataTrait;
use Vitlabs\GUICore\Traits\ElementTrait;
use Vitlabs\GUICore\Contracts\Elements\BasicElementContract;

class BasicElement implements BasicElementContract {

    use DataTrait, ElementTrait {
        DataTrait::postConstruct insteadof ElementTrait;
    }

    protected $view = '';

    protected $optionals = [];

    public function setView($view)
    {
    	$this->view = $view;
    	return $this;
    }

    public function getView()
    {
    	return $this->view;
    }

    public function render()
    {
        foreach ($this->optionals as $key => $val)
        {
            if (is_int($key))
            {
                $this->setOptional($val);
            }
            else
            {
                $this->setDefault($key, $val);
            }
        }

    	return $this->renderView($this->view, $this->getData());
    }
    
}
