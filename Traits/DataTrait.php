<?php

namespace Vitlabs\GUICore\Traits;

trait DataTrait {

	protected $data = [];

	public function __construct(array $data = [])
	{
		$this->setMany($data);
	}

	public function postConstruct()
	{
		$this->set('resourceBag', $this->getGenerator()->getResourceBag());
	}

	public function setMany(array $data)
	{
		$this->data = array_merge($this->data, $data);

		return $this;
	}

	public function set($variable, $value)
	{
		$this->data[$variable] = $value;

		return $this;
	}

	public function __set($variable, $value)
	{
		return $this->set($variable, $value);
	}

	public function getMany(array $variables)
	{
		$data = [];

		foreach ($variables as $variable)
		{
			$data[$variable] = (isset($this->data[$variable])) ? $this->data[$variable] : null;
		}

		return $data;
	}

	public function get($variable)
	{
		return (isset($this->data[$variable]) ? $this->data[$variable] : null);
	}

	public function __get($variable)
	{
		return $this->get($variable);
	}

	public function getData()
	{
		return $this->data;
	}

	public function has($variable)
	{
		return (isset($this->data[$variable]));
	}

	public function setOptional($variable)
	{
		if ( ! isset($this->data[$variable]))
		{
			$this->data[$variable] = null;
		}

		return $this;
	}

	public function setOptionals(array $variables)
	{
		foreach ($variables as $variable)
		{
			$this->setOptional($variable);
		}

		return $this;
	}

	public function setDefault($variable, $value)
	{
		if ( ! isset($this->data[$variable]))
		{
			$this->data[$variable] = $value;
		}

		return $this;
	}

	public function getOrSet($variable, $value = null)
	{
		if (is_null($value))
        {
            return $this->get($variable);
        }
        else
        {
            $this->set($variable, $value);

            return $this;
        }
	}

}
