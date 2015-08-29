<?php

namespace Vitlabs\GUICore\Menu;

use Exception;
use Illuminate\Support\Facades\View;
use Vitlabs\GUICore\Contracts\Menu\MenuPresenterContract;
use Vitlabs\GUICore\Contracts\Menu\HeadingContract;
use Vitlabs\GUICore\Contracts\Menu\LinkContract;
use Vitlabs\GUICore\Contracts\Menu\MenuContract;

abstract class AbstractMenuPresenter implements MenuPresenterContract
{
    // Views
    protected $viewsPrefix = '';

    // Wrap
    protected $wrapTag = 'ul';
    protected $wrapClass = '';

    // Heading
    protected $headingTag = 'li';
    protected $headingClass = '';

    // Link
    protected $linkTag = 'li';
    protected $linkClass = '';
    protected $linkActiveClass = 'active';
    protected $linkClassWithSubmenu = '';

    // Link title
    protected $linkTitleTag = '';
    protected $linkTitleClass = '';
    protected $linkTitlePrefix = '';
    protected $linkTitlePrefixWithSubmenu = '';
    protected $linkTitleSuffix = '';
    protected $linkTitleSuffixWithSubmenu = '';

    // Submenu presenter
    protected $submenuPresenter = null;

    public function present(MenuContract $menu)
    {
        // Starting tag
        $result = '<' . $this->getWrapTag();

        // Add wrap class
        $wrapClass = $this->getWrapClass();

        if ($wrapClass != '')
        {
            $result .= ' class="' . $wrapClass . '"';
        }

        $result .= '>';

        // Present items
        foreach ($menu->getItems() as $item)
        {
            // Item is heading
            if ($item instanceof HeadingContract)
            {
                $result .= $this->presentHeading($item);
            }

            // Item is link
            elseif ($item instanceof LinkContract)
            {
                $result .= $this->presentLink($item);
            }

            // Can't present item
            else
            {
                throw new Exception('Unsupported menu item type [' . get_class($item) . '].');
            }
        }

        // Closing tag
        $result .= '</' . $this->getWrapTag() . '>';

        // Return result
        return $result;
    }

    protected function renderView($view, array $data)
    {
        return View::make(config('gui-core.viewsHint') . '::' . $this->viewsPrefix . $view, $data)->render();
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
    public function getWrapTag()
    {
        return $this->wrapTag;
    }

    public function setWrapTag($wrapTag)
    {
        $this->wrapTag = $wrapTag;

        return $this;
    }

    public function getWrapClass()
    {
        return $this->wrapClass;
    }

    public function setWrapClass($wrapClass)
    {
        $this->wrapClass = $wrapClass;

        return $this;
    }

    public function getHeadingTag()
    {
        return $this->headingTag;
    }

    public function setHeadingTag($headingTag)
    {
        $this->headingTag = $headingTag;

        return $this;
    }

    public function getHeadingClass()
    {
        return $this->headingClass;
    }

    public function setHeadingClass($headingClass)
    {
        $this->headingClass = $headingClass;

        return $this;
    }

    public function getLinkTag()
    {
        return $this->linkTag;
    }

    public function setLinkTag($linkTag)
    {
        $this->linkTag = $linkTag;

        return $this;
    }

    public function getLinkClass()
    {
        return $this->linkClass;
    }

    public function setLinkClass($linkClass)
    {
        $this->linkClass = $linkClass;

        return $this;
    }

    public function getLinkActiveClass()
    {
        return $this->linkActiveClass;
    }

    public function setLinkActiveClass($linkActiveClass)
    {
        $this->linkActiveClass = $linkActiveClass;

        return $this;
    }

    public function getLinkClassWithSubmenu()
    {
        return $this->linkClassWithSubmenu;
    }

    public function setLinkClassWithSubmenu($linkClassWithSubmenu)
    {
        $this->linkClassWithSubmenu = $linkClassWithSubmenu;

        return $this;
    }

    public function getLinkTitleTag()
    {
        return $this->linkTitleTag;
    }

    public function setLinkTitleTag($linkTitleTag)
    {
        $this->linkTitleTag = $linkTitleTag;

        return $this;
    }

    public function getLinkTitleClass()
    {
        return $this->linkTitleClass;
    }

    public function setLinkTitleClass($linkTitleClass)
    {
        $this->linkTitleClass = $linkTitleClass;

        return $this;
    }

    public function getLinkTitlePrefix()
    {
        return $this->linkTitlePrefix;
    }

    public function setLinkTitlePrefix($linkTitlePrefix)
    {
        $this->linkTitlePrefix = $linkTitlePrefix;

        return $this;
    }

    public function getLinkTitlePrefixWithSubmenu()
    {
        return $this->linkTitlePrefixWithSubmenu;
    }

    public function setLinkTitlePrefixWithSubmenu($linkTitlePrefixWithSubmenu)
    {
        $this->linkTitlePrefixWithSubmenu = $linkTitlePrefixWithSubmenu;

        return $this;
    }

    public function getLinkTitleSuffix()
    {
        return $this->linkTitleSuffix;
    }

    public function setLinkTitleSuffix($linkTitleSuffix)
    {
        $this->linkTitleSuffix = $linkTitleSuffix;

        return $this;
    }

    public function getLinkTitleSuffixWithSubmenu()
    {
        return $this->linkTitleSuffixWithSubmenu;
    }

    public function setLinkTitleSuffixWithSubmenu($linkTitleSuffixWithSubmenu)
    {
        $this->linkTitleSuffixWithSubmenu = $linkTitleSuffixWithSubmenu;

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

    /* Abstract methods */
    abstract public function presentHeading(HeadingContract $heading);

    abstract public function presentLink(LinkContract $link);

}
