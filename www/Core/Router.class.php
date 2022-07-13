<?php

namespace App\Core;

use App\Model\Article;
use App\Model\Page;

class Router
{
  public function getPages($uri)
  {
    $explode = explode('/', $uri);
    $implode = implode($explode);

    $page = new Page;
    $foundPage = $page->findOne(['page_slug' => $implode]);
    
    if ($foundPage !== false) {
      $uri = '/page/show';
      return $uri;
    } else {
      return false;
    }
  }

  public function getArticles($uri)
  {
    $explode = explode('/', $uri);
    $implode = implode($explode);

    $article = new Article;
    $foundArticle = $article->findOne(['article_slug' => $implode]);

    if ($foundArticle !== false) {
      $uri = '/article/show';
      return $uri; 
    } else {
      return false;
    }
  }
}