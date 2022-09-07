<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Page as PageModel;
use App\Model\User;

class Page
{
    public function index()
    {
        session_start();
        $page = new PageModel();
        $user = new User();
        $connectedUser = $user->findOne(['id' => $_SESSION['userId']]);
        $pages = $page->panelPages($connectedUser->getPanelId());

        $view = new View("view-pages");
        $view->assign("pages", $pages);
        $view->assign("connectedUser", $connectedUser);
    }

    public function add()
    {
        session_start();
        $page = new PageModel();
        $user = new User();
        $connectedUserId = $_SESSION['userId'];
        $connectedUser = $user->findOne(['id' => $connectedUserId]);

        if (!empty($_POST)) {
            $page->setPageAuthorId($connectedUserId);
            $page->setPageTitle(strip_tags($_POST['page_title']));
            $page->setPageSlug(strip_tags($_POST['page_slug']));
            $page->setPageContent($_POST['page_content']);
            $page->setPagePanelId($connectedUser->getPanelId());
            $page = $page->save();

            header("Location: /pages");
        }

        $view = new View("add-pages");
        $view->assign("page", $page);
    }

    public function show()
    {
        $page = new PageModel();

        $uri = $_SERVER["REQUEST_URI"];
        $explode = explode('/', $uri);
        $implode = implode($explode);

        $page = $page->findOne(['page_slug' => $implode]);

        $view = new View("page");
        $view->assign("page", $page);
    }

    public function edit()
    {
        if (empty($_GET['id'])) {
            header("Location: /pages");
        } else {
            $page = new PageModel();
            $pageId = $_GET['id'];
            $page = $page->findOne(['id' => $pageId]);
            if ($page === false) {
                header("Location: /page");
            } else {
                $view = new View("edit-page");
                $view->assign("page", $page);
            }
        }
    }

    public function update()
    {
        if (empty($_GET['id'])) {
            header("Location: /pages");
        } else {
            $page = new PageModel();
            $pageId = $_GET['id'];
            $page = $page->findOne(['id' => $pageId]);

            if ($page === false) {
                header("Location: /users");
            } else {
                $page->setPageTitle(strip_tags($_POST['page_title']));
                $page->setPageSlug(strip_tags($_POST['page_slug']));
                $page->setPageContent(strip_tags($_POST['page_content']));

                $page->save();

                header("Location: /pages");
            }
        }
    }

    public function delete()
    {
        $page = new PageModel();
        $pageId = $_GET['id'];
        $page->delete($pageId);

        header("Location: /pages");
    }
}
