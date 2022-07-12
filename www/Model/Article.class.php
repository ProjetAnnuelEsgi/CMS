<?php

namespace App\Model;

use App\Core\Sql;

class Article extends Sql

{
    protected $id = null;
    protected $article_title = null;
    protected $article_slug = null;
    protected $article_content = null;
    protected $article_status = 0;
    protected $article_publishAt = null;
    protected $article_authorId = null;
    protected $article_categoryId = null;
    protected $article_createdAt = null;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of article_title
     */ 
    public function getArticleTitle()
    {
        return $this->article_title;
    }

    /**
     * Set the value of article_title
     *
     * @return  self
     */ 
    public function setArticleTitle($article_title)
    {
        $this->article_title = $article_title;

        return $this;
    }

    /**
     * Get the value of article_slug
     */ 
    public function getArticleSlug()
    {
        return $this->article_slug;
    }

    /**
     * Set the value of article_slug
     *
     * @return  self
     */ 
    public function setArticleSlug($article_slug)
    {
        $this->article_slug = strtolower(trim(str_replace(' ', '-',$article_slug)));

        return $this;
    }

    /**
     * Get the value of article_content
     */ 
    public function getArticleContent()
    {
        return $this->article_content;
    }

    /**
     * Set the value of article_content
     *
     * @return  self
     */ 
    public function setArticleContent($article_content)
    {
        $this->article_content = $article_content;

        return $this;
    }

    /**
     * Get the value of article_status
     */ 
    public function getArticleStatus()
    {
        return $this->article_status;
    }

    /**
     * Set the value of article_status
     *
     * @return  self
     */ 
    public function setArticleStatus($article_status)
    {
        $this->article_status = $article_status;

        return $this;
    }

    /**
     * Get the value of article_publishAt
     */ 
    public function getArticlePublishAt()
    {
        return $this->article_publishAt;
    }

    /**
     * Set the value of article_publishAt
     *
     * @return  self
     */ 
    public function setArticlePublishAt($article_publishAt)
    {
        $this->article_publishAt = $article_publishAt;

        return $this;
    }

    /**
     * Get the value of article_authorId
     */ 
    public function getArticleAuthorId()
    {
        return $this->article_authorId;
    }

    /**
     * Set the value of article_authorId
     *
     * @return  self
     */ 
    public function setArticleAuthorId($article_authorId)
    {
        $this->article_authorId = $article_authorId;

        return $this;
    }



    /**
     * Get the value of article_categoryId
     */ 
    public function getArticleCategoryId()
    {
        return $this->article_categoryId;
    }

    /**
     * Set the value of article_categoryId
     *
     * @return  self
     */ 
    public function setArticleCategoryId($article_categoryId)
    {
        $this->article_categoryId = $article_categoryId;

        return $this;
    }

    /**
     * Get the value of article_createdAt
     */ 
    public function getArticleCreatedAt()
    {
        return $this->article_createdAt;
    }
}