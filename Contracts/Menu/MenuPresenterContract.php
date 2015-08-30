<?php

namespace Vitlabs\GUICore\Contracts\Menu;

use Vitlabs\GUICore\Contracts\Menu\MenuContract;

interface MenuPresenterContract
{

    function present(MenuContract $menu);

    function presentSubmenu(MenuContract $submenu);

    function getLinkActiveClass();

    function setLinkActiveClass($linkActiveClass);

    function setSubmenuPresenter(MenuPresenterContract $submenuPresenter);

    function getSubmenuPresenter();

}