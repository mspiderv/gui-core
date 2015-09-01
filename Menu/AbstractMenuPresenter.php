<?php

namespace Vitlabs\GUICore\Menu;

use Exception;
use Illuminate\Support\Facades\View;
use Vitlabs\GUICore\Contracts\Menu\MenuPresenterContract;
use Vitlabs\GUICore\Contracts\Menu\DividerContract;
use Vitlabs\GUICore\Contracts\Menu\HeadingContract;
use Vitlabs\GUICore\Contracts\Menu\LinkContract;
use Vitlabs\GUICore\Contracts\Menu\MenuContract;

abstract class AbstractMenuPresenter implements MenuPresenterContract
{
    // Views
    protected $viewsPrefix = '';

    // Link
    protected $linkActiveClass = 'active';

    // Submenu presenter
    protected $submenuPresenter = null;

    public function present(MenuContract $menu)
    {
        $result = '';

        // Starting tag
        $result .= $this->openWrap($menu);

        // Present items
        foreach ($menu->getItems() as $item)
        {
            unset($presentResult);

            // Item is link
            if ($item instanceof LinkContract)
            {
                $presentResult = $this->presentLink($item);

                $this->checkPresentResult($presentResult, 'link');

                $result .= $presentResult;
            }

            // Item is heading
            elseif ($item instanceof HeadingContract)
            {
                $presentResult = $this->presentHeading($item);

                $this->checkPresentResult($presentResult, 'heading');

                $result .= $presentResult;
            }

            // Item is divider
            elseif ($item instanceof DividerContract)
            {
                $presentResult = $this->presentDivider($item);

                $this->checkPresentResult($presentResult, 'divider');

                $result .= $presentResult;
            }

            // Can't present item
            else
            {
                throw new Exception('Unsupported menu item type [' . get_class($item) . '] in presenter [' . static::class . '].');
            }
        }

        // Closing tag
        $result .= $this->closeWrap($menu);

        // Return result
        return $result;
    }

    protected function checkPresentResult($result, $type = 'unknown')
    {
        if ($result === false)
        {
            throw new Exception('Presenter [' . static::class . '] have no presenting implementation for [' . $type . '] menu item type.');
        }
    }

    protected function openWrap(MenuContract $menu)
    {
        return '';
    }

    protected function closeWrap(MenuContract $menu)
    {
        return '';
    }

    protected function renderView($view, array $data)
    {
        return View::make($this->getPackageName() . '::' . $this->viewsPrefix . $view, $data)->render();
    }

    public function presentSubmenu(MenuContract $submenu)
    {
        if ($this->submenuPresenter == null)
        {
            throw new Exception('Cannot present submenu, because submenu presenter is not set.');
        }

        return $this->submenuPresenter->present($submenu);
    }

    /* Getters & Setters */
    public function getLinkActiveClass()
    {
        return $this->linkActiveClass;
    }

    public function setLinkActiveClass($linkActiveClass)
    {
        $this->linkActiveClass = $linkActiveClass;

        return $this;
    }

    public function getSubmenuPresenter()
    {
        return $this->submenuPresenter;
    }

    public function setSubmenuPresenter(MenuPresenterContract $submenuPresenter)
    {
        $this->submenuPresenter = $submenuPresenter;

        return $this;
    }

    protected function presentDivider(DividerContract $heading)
    {
        return false;
    }

    protected function presentHeading(HeadingContract $heading)
    {
        return false;
    }

    protected function presentLink(LinkContract $link)
    {
        return false;
    }

}
