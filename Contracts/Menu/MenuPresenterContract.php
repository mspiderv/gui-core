<?php

namespace Vitlabs\GUICore\Contracts\Menu;

use Vitlabs\GUICore\Contracts\Menu\MenuContract;

interface MenuPresenterContract
{

    function present(MenuContract $menu);

    function presentSubmenu(MenuContract $submenu);

    /* Getters & Setters */
    function getWrapTag();
    function setWrapTag($wrapTag);

    function getWrapClass();
    function setWrapClass($wrapClass);

    function getHeadingTag();
    function setHeadingTag($headingTag);

    function getHeadingClass();
    function setHeadingClass($headingClass);

    function getLinkTag();
    function setLinkTag($linkTag);

    function getLinkClass();
    function setLinkClass($linkClass);

    function getLinkActiveClass();
    function setLinkActiveClass($linkActiveClass);

    function getLinkClassWithSubmenu();
    function setLinkClassWithSubmenu($linkClassWithSubmenu);

    function getLinkTitleTag();
    function setLinkTitleTag($linkTitleTag);

    function getLinkTitleClass();
    function setLinkTitleClass($linkTitleClass);

    function getLinkTitlePrefix();
    function setLinkTitlePrefix($linkTitlePrefix);

    function getLinkTitlePrefixWithSubmenu();
    function setLinkTitlePrefixWithSubmenu($linkTitlePrefixWithSubmenu);

    function getLinkTitleSuffix();
    function setLinkTitleSuffix($linkTitleSuffix);

    function getLinkTitleSuffixWithSubmenu();
    function setLinkTitleSuffixWithSubmenu($linkTitleSuffixWithSubmenu);

    function setSubmenuPresenter(MenuPresenterContract $submenuPresenter);
    function getSubmenuPresenter();

}