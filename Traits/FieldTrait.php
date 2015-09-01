<?php

namespace Vitlabs\GUICore\Traits;

trait FieldTrait {

    public function __construct()
    {
        //
    }

	/**
     * Get/set element name.
     * @param  string $name
     * @return value/$this
     */
    public function name($name)
    {
        return $this->getOrSet('name', $name);
    }

    /**
     * Get/set element value.
     * @param  string $value
     * @return value/$this
     */
    public function value($value)
    {
        return $this->getOrSet('value', $value);
    }

    /**
     * Get/set element id.
     * @param  string $id
     * @return value/$this
     */
    public function id($id)
    {
        return $this->getOrSetAttribute('id', $id);
    }

    /**
     * Is element disabled/Enable/Disable element.
     * @param  boolean $disabled
     * @return boolean/$this
     */
    public function disabled($disabled = null)
    {
        if ($disabled == null)
        {
            return $this->hasAttribute('disabled');
        }

        else
        {
            $disabled ? $this->setAttribute('disabled', 'disabled') : $this->removeAttribute('disabled');

            return $this;
        }
    }

    /**
     * Get escaped current element value by htmlspecialchars PHP function.
     * @return string
     */
    public function getEscapedValue()
    {
        return htmlspecialchars($this->get('value'));
    }

    /**
     * Disable the element.
     * @return $this
     */
    public function disable()
    {
        $this->setAttribute('disabled', 'disabled');

        return $this;
    }

    /**
     * Enable the element.
     * @return $this
     */
    public function enable()
    {
        $this->removeAttribute('disabled');

        return $this;
    }

    public function render()
    {
        return $this->renderEditor();
    }

}
