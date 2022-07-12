<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Page as PageModel;

class Page
{
    public function index()
    {
        $page = new PageModel();
        $pages = $page->findAll();

        $view = new View("viewPages");
        $view->assign("pages", $pages);
    }

    public function add()
    {
        $page = new PageModel();

        if (!empty($_POST)) {

            $page->setPageTitle($_POST['page_title']);
            $page->setPageSlug($_POST['page_slug']);
            $page->setPageContent($_POST['page_content']);
            $page = $page->save();

            header("Location: /pages");
        }

        $view = new View("addPages");
        $view->assign("page", $page);
    }

    public function showPage()
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
                $view = new View("editPage");
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
                $page->setPageTitle($_POST['page_title']);
                $page->setPageSlug($_POST['page_slug']);
                $page->setPageContent($_POST['page_content']);

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
