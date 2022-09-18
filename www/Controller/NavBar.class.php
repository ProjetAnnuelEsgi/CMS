<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Menu as MenuModel;
use App\Model\User as UserModel;
use App\Model\Page as PageModel;

class Navbar
{
    public function index()
    {
        session_start();

        $user = new UserModel();
        $userId = $_SESSION['userId'];
        $user = $user->findOne(['id' => $userId]);

        $menu = new MenuModel();
        $menus = $menu->panelMenu($user->getPanelId());

        $pages = [];

        foreach ($menus as $menu) {

            $page = new PageModel;

            $p = $page->findOne(["id" => $menu['page_id']]);
            array_push($pages, $p);

            foreach ($pages as $p) {
            }
        }

        $_SESSION['pages'] = $pages;

        $view = new View("site-front", "front");
    }
}
