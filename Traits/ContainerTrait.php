<?php

namespace Vitlabs\GUICore\Traits;

use Vitlabs\GUICore\Contracts\Elements\ElementContract;

trait ContainerTrait {

	protected $container = [];

	public function __construct(array $container = [])
	{
        foreach ($container as $element)
        {
            $this->add($element);
        }
	}

    public function add(ElementContract $e, $position = null)
    {
    	$this->container[$this->getPositionName($position)][] = $e;

    	return $this;
    }

    public function getAllElements()
    {
    	$elements = [];

    	foreach ($this->getPositions() as $position)
    	{
    		$elements = array_merge($elements, $this->container[$position]);
    	}

    	return $elements;
    }

    public function getPositionElements($position = null)
    {
    	$position = $this->getPositionName($position);

    	return (isset($this->container[$position]) && is_array($this->container[$position])) ? $this->container[$position] : [];
    }

    public function removeElements()
    {
    	$this->container = [];

    	return $this;
    }

    public function removePositionElements($position = null)
    {
    	$position = $this->getPositionName($position);

    	if (is_array($this->container[$position]))
    	{
            unset($this->container[$position]);
    	}

    	return $this;
    }

    public function getPositions()
    {
    	return array_keys($this->container);
    }

    public function renderElements(array $elements)
    {
        $result = '';

        foreach ($elements as $e)
        {
            $result .= $e->render();
        }

        return $result;
    }

    public function getDefaultPositionName()
    {
        return 'default';
    }

    protected function getPositionName($position = null)
    {
    	return (is_null($position)) ? $this->getDefaultPositionName() : $position;
    }

    public function __call($method, $args = array())
    {
        /*
         * ContainerElement $e
         * $x->toPOSITION($e) = $e->to($x, 'POSITION');
         */
        if (substr($method, 0, 2) == 'to' && isset($args[0]))
        {
            return $this->to($args[0], lcfirst(substr($method, 2)));
        }

        /*
         * ContainerElement $e
         * $e->addPOSITION($x) = $e->add($x, 'POSITION');
         */
        if (substr($method, 0, 3) == 'add' && isset($args[0]))
        {
            return $this->add($args[0], lcfirst(substr($method, 3)));
        }

        return static::__call($method, $args);
    }

}
