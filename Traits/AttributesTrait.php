<?php

namespace Vitlabs\GUICore\Traits;

trait AttributesTrait {

	protected $attributes = [];

	public function __construct(array $attributes = [])
	{
		$this->attributes = $attributes;
	}

	public function attr($attribute, $value = null)
	{
		return is_null($value) ? $this->getAttribute($attribute) : $this->setAttribute($attribute, $value);
	}

	public function setAttribute($attribute, $value)
	{
		$this->attributes[$attribute] = $value;

		return $this;
	}

	public function appendAttribute($attribute, $appendValue)
	{
		if (isset($this->attributes[$attribute]))
		{
			$this->attributes[$attribute] .= $appendValue;
		}
		else
		{
			$this->attributes[$attribute] = $appendValue;
		}

		return $this;
	}

	public function getAttribute($attribute)
	{
		return isset($this->attributes[$attribute]) ? $this->attributes[$attribute] : '';
	}

	public function removeAttribute($attribute)
	{
		if (isset($this->attributes[$attribute]))
		{
			unset($this->attributes[$attribute]);
		}

		return $this;
	}

	public function hasAttribute($attribute)
	{
		return isset($this->attributes[$attribute]);
	}

	public function getAttributes()
	{
		return $this->attributes;
	}

	public function parseAttributes($withSpace = true, $attributes = null)
	{
		$result = '';

		if (is_null($attributes))
		{
			$attributes = $this->attributes;
		}

		foreach ($attributes as $attribute => $value)
		{
			$result .= ' ' . $attribute.'="'.$value.'"';
		}

		return ($withSpace) ? $result : substr($result, 1);
	}

	public function addClass($class)
    {
        $this->appendAttribute('class',  ($this->hasAttribute('class') ? ' ' : '') . $class);

        return $this;
    }

    public function removeClass($class)
    {
    	// Trim first
    	$this->attributes['class'] = trim($this->attributes['class']);

    	// Remove double spaces
    	while(strpos($this->attributes['class'], '  ') !== false)
    	{
    		$this->attributes['class'] = str_replace('  ', ' ', $this->attributes['class']);
    	}

    	// Explode to classes
        $classes = explode(' ', $this->attributes['class']);

        // Remove class
        $classes = array_diff($classes, [$class]);

        // Implode to string
        $this->attributes['class'] = implode(' ', $classes);

        // Return $this to allow method chaining
        return $this;
    }

    public function getOrSetAttribute($variable, $value = null)
	{
		if ($value == null)
        {
            return $this->getAttribute($variable);
        }
        else
        {
            $this->setAttribute($variable, $value);

            return $this;
        }
	}
    
}
