<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Menu as MenuModel;
use App\Model\User as UserModel;
use App\Model\Page as PageModel;

class Menu
{
    public function index()
    {
        $page = new PageModel();
        $pages = $page->findAll();

        $view = new View("view-menus");
        $view->assign("pages", $pages);
    }

    public function add()
    {
        session_start();

        $menu = new MenuModel();

        $user = new UserModel();
        $userId = $_SESSION['userId'];
        $user = $user->findOne(['id' => $userId]);

        $menu->setShow(1);
        $menu->setPageId($_GET['id']);
        $menu->setMenu_panelId($user->getPanelId());

        $menu->save();

        $view = new View("add-menu");
    }

    public function show()
    {
        $view = new View("show-menu");
    }

    public function edit()
    {
        $view = new View("edit-menu");
    }

    public function update()
    {

    }

    public function remove()
    {
        session_start();

        $menu = new MenuModel();

        $user = new UserModel();
        $userId = $_SESSION['userId'];
        $user = $user->findOne(['id' => $userId]);

        $menu->setShow(1);
        $menu->setPageId($_GET['id']);
        $menu->setMenu_panelId($user->getPanelId());

        $menu->save();

        $view = new View("remove-menu");
    }
}