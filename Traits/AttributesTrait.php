<?php

namespace Vitlabs\GUICore\Traits;

trait AttributesTrait {

	protected $attributes = [];

	public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
    }

	public function attr($attribute, $value = null, & $attributes = null)
	{
		return is_null($value) ? $this->getAttribute($attribute, $attributes) : $this->setAttribute($attribute, $value, $attributes);
	}

	public function setAttribute($attribute, $value, & $attributes = null)
	{
        if (is_null($attributes))
        {
            $attributes = & $this->attributes;
        }

		$attributes[$attribute] = $value;

		return $this;
	}

    public function setAttributes(array $attributes = [])
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }

	public function appendAttribute($attribute, $appendValue, & $attributes = null)
	{
        if (is_null($attributes))
        {
            $attributes = & $this->attributes;
        }

		if (isset($attributes[$attribute]))
		{
			$attributes[$attribute] .= $appendValue;
		}
		else
		{
			$attributes[$attribute] = $appendValue;
		}

		return $this;
	}

	public function getAttribute($attribute, & $attributes = null)
	{
        if (is_null($attributes))
        {
            $attributes = & $this->attributes;
        }

		return isset($attributes[$attribute]) ? $attributes[$attribute] : '';
	}

	public function removeAttribute($attribute)
	{
		unset($this->attributes[$attribute]);

		return $this;
	}

	public function hasAttribute($attribute, & $attributes = null)
	{
        if (is_null($attributes))
        {
            $attributes = & $this->attributes;
        }

		return isset($attributes[$attribute]);
	}

	public function getAttributes()
	{
		return $this->attributes;
	}

	public function parseAttributes($withSpace = true, & $attributes = null)
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

	public function addClass($class, & $attributes = null)
    {
        $this->appendAttribute('class',  ($this->hasAttribute('class', $attributes) ? ' ' : '') . $class, $attributes);

        return $this;
    }

    public function removeClass($class)
    {
        // There are no classes. We are done.
        if ( ! isset($this->attributes['class']))
        {
            return $this;
        }

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
		if ($value === null)
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
