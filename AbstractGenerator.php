<?php

namespace Vitlabs\GUICore;

use Illuminate\Contracts\Foundation\Application;
use Vitlabs\GUICore\Contracts\GeneratorContract;

abstract class AbstractGenerator implements GeneratorContract
{
	protected $app;
    protected $resourceBag;
    protected $elements = [];
    protected $contractSuffix = 'Contract';

	public function __construct(Application $app)
	{
		$this->app = $app;
        $this->resourceBag = new ResourceBag($this->getAssetsPath());
	}

    public function makeClassName($element)
    {
        return ucfirst($element);
    }

    public function makeElementKey($element)
    {
        return strtolower($element);
    }

    public function makeViewName($element)
    {
        return lcfirst($element);
    }

    public function registerElement($element, $contractNamespace, $implementationNamespace)
    {
        // Class name
        $className = $this->makeClassName($element);

        // Element key
        $elementKey = $this->makeElementKey($element);

        // Bind element implementation
        $this->app->bind($contractNamespace . $className . $this->contractSuffix, $implementationNamespace . $className);

        // Register element
        $this->elementContracts[$elementKey] = $contractNamespace . $className . $this->contractSuffix;
    }

    public function getElementContract($element)
    {
        // Element key
        $elementKey = $this->makeElementKey($element);

        return (isset($this->elementContracts[$elementKey])) ? $this->elementContracts[$elementKey] : null;
    }

    public function isElementRegistered($element)
    {
        // Element key
        $elementKey = $this->makeElementKey($element);

        return (isset($this->elementContracts[$elementKey]));
    }

    public function getResourceBag()
    {
        return $this->resourceBag;
    }

	protected function generate($elementName, array $args)
	{
        // Class name
        $className = $this->makeClassName($elementName);

        // Element key
        $elementKey = $this->makeElementKey($elementName);

        // View name
        $viewName = $this->makeViewName($elementName);

        // Contract interface
        $contract = $this->getElementContract($elementName);

        // Does the contract exists ?
        if ($contract != null && interface_exists($contract))
        {
            // Create element instance
            $element = $this->app->make($contract, $args);
        }
        else
        {
            // Element contract does not exists. Let's create BasicElement.
            $element = $this->app->make('Vitlabs\GUICore\Contracts\Elements\BasicElementContract');
            $element->setView($viewName);
            
            // Set args
            if (isset($args[0]))
            {
                $element->setMany($args[0]);
            }
        }

        // Set generator
        $element->setGenerator($this);

        // Add element resources
        $this->resourceBag->add($element->needResources());

        // Call post construct
        $element->postConstruct();

        // Return element
        return $element;
	}

    protected function getAssetsPath()
    {
        return config('gui-core.viewsGroup') . '/';
    }
    
}