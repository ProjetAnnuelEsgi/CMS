<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Article as ArticleModel;

class Article
{
    public function index()
    {
        $article = new ArticleModel();
        $articles = $article->findAll();

        $view = new View("viewArticles");
        $view->assign("articles", $articles);
    }

    public function add()
    {
        $article = new ArticleModel();
    
        if (!empty($_POST)) {
            $article->setArticleTitle($_POST['article_title']);
            $article->setArticleSlug($_POST['article_slug']);
            $article->setArticleContent($_POST['article_content']);
            $article = $article->save();
            
            header("Location: /articles");
        }
        
        $view = new View("addArticles");
        $view->assign("article", $article);
    }

    public function showArticle()
    {
        $article = new ArticleModel();

        $uri = $_SERVER["REQUEST_URI"];
        $explode = explode('/', $uri);
        $implode = implode($explode);

        $article = $article->findOne(['article_slug' => $implode]);
        
        $view = new View("article");
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
                $view = new View("editArticle");
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
                $article->setArticleTitle($_POST['article_title']);
                $article->setArticleSlug($_POST['article_slug']);
                $article->setArticleContent($_POST['article_content']);

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