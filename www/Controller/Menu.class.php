<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Menu as ModelMenu;
use App\Model\User as UserModel;
use App\Model\Page as PageModel;

class Menu
{
    public function index()
    {
        session_start();

        $page = new PageModel();
        $user = new UserModel();
        $menu = new ModelMenu();

        $allMenuPageId = [];

        $connectedUser = $user->findOne(['id' => $_SESSION['userId']]);
        $pages = $page->panelPages($connectedUser->getPanelId());

        $menus = $menu->panelMenu($connectedUser->getPanelId());

        if (count($menus) > 0) {
            foreach ($menus as $menu) {
                array_push($allMenuPageId, $menu['page_id']);
            }
        }

        $view = new View("view-menus");
        $view->assign("pages", $pages);
        $view->assign("allMenuPageId", $allMenuPageId);
    }

    public function add()
    {
        session_start();


        $user = new UserModel();
        $userId = $_SESSION['userId'];
        $user = $user->findOne(['id' => $userId]);

        $menu = new ModelMenu;

        $menu->setVisibility(1);
        $menu->setPageId($_GET['id']);
        $menu->setMenuPanelId($user->getPanelId());

        $menu->save();

        echo "<script>;alert('La page a été ajouté à votre menu avec succès.'); </script>";

        header("location: /menus");
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

    public function delete()
    {
        $pageId = $_GET['id'];

        $menu = new ModelMenu();

        $foundMenu = $menu->findOne(['page_id' => $pageId]);

        $menuId = $foundMenu->getId();

        $menu->delete($menuId);

        echo "<script>;alert('La page a été retiré de votre menu avec succès.'); </script>";

        header("location: /menus");
    }
}
