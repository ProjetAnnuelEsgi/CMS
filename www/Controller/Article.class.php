<?php

namespace App\Controller;

use App\Core\Observer\Article as ObserverArticle;
use App\Core\Observer\Creator;
use App\Core\View;
use App\Model\Article as ArticleModel;
use App\Model\User;

class Article
{
    public function index()
    {
        session_start();
        $article = new ArticleModel();
        $user = new User();

        $connectedUser = $user->findOne(['id' => $_SESSION['userId']]);
        $articles = $article->panelArticles($connectedUser->getPanelId());

        $view = new View("view-articles");
        $view->assign("articles", $articles);
        $view->assign("connectedUser", $connectedUser);
    }

    public function add()
    {
        session_start();
        $article = new ArticleModel();
        $user = new User();
        $connectedUserId = $_SESSION['userId'];
        $connectedUser = $user->findOne(['id' => $connectedUserId]);

        if (!empty($_POST)) {
            $article->setArticleAuthorId($connectedUserId);
            $article->setArticleTitle(strip_tags($_POST['article_title']));
            $article->setArticleSlug(strip_tags($_POST['article_slug']));
            $article->setArticleContent($_POST['article_content']);
            $article->setArticlePanelId($connectedUser->getPanelId());

            $article = $article->save();

            // $observer = new Creator();
            // $article = new ObserverArticle();
            // $article->attach($observer);
            // $article->breakOutNews($_POST['article_title']);
            // $observer->getContent();

            header("Location: /articles");
        }

        $view = new View("add-articles");
        $view->assign("article", $article);
    }

    public function show()
    {
        $article = new ArticleModel();

        $uri = $_SERVER["REQUEST_URI"];
        $explode = explode('/', $uri);
        $implode = implode($explode);

        $article = $article->findOne(['article_slug' => $implode]);

        $view = new View("article", "front");
        $view->assign("article", $article);
    }

    public function edit()
    {
        if (empty($_GET['id'])) {
            header("Location: /articles");
        } else {
            $article = new ArticleModel();
            $articleId = $_GET['id'];
            $article = $article->findOne(['id' => $articleId]);
            if ($article === false) {
                header("Location: /articles");
            } else {
                $view = new View("edit-article");
                $view->assign("article", $article);
            }
        }
    }

    public function update()
    {
        if (empty($_GET['id'])) {
            header("Location: /articles");
        } else {
            $article = new ArticleModel();
            $articleId = $_GET['id'];
            $article = $article->findOne(['id' => $articleId]);

            if ($article === false) {
                header("Location: /users");
            } else {
                $article->setArticleTitle(strip_tags($_POST['article_title']));
                $article->setArticleSlug(strip_tags($_POST['article_slug']));
                $article->setArticleContent(strip_tags($_POST['article_content']));

                $article->save();

                header("Location: /articles");
            }
        }
    }

    public function delete()
    {
        $article = new ArticleModel();
        $articleId = $_GET['id'];
        $article->delete($articleId);

        header("Location: /articles");
    }
}
