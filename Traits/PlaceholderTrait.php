<?php

namespace Vitlabs\GUICore\Traits;

trait PlaceholderTrait {

	/**
	 * Get/set element placeholder.
	 * @param string $placeholder
	 * @return value/string
	 */
	public function placeholder($placeholder = null)
	{
		if (is_null($placeholder))
		{
			return $this->getAttribute('placeholder');
		}

		else
		{
			$this->setAttribute('placeholder', $placeholder);
			$this->setAttribute('data-placeholder', $placeholder);

			return $this;
		}
	}
	
}
