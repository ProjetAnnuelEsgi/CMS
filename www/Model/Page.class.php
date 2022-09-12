<?php

namespace App\Model;

use App\Core\Sql;

class Page extends Sql
{
    protected $id = null;
    protected $page_title = null;
    protected $page_slug = null;
    protected $page_content = null;
    protected $page_authorId = null;
    protected $page_panelId = null;
    protected $page_createdAt = null;
    

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
     * Get the value of page_title
     */ 
    public function getPageTitle()
    {
        return $this->page_title;
    }

    /**
     * Set the value of page_title
     *
     * @return  self
     */ 
    public function setPageTitle($page_title)
    {
        $this->page_title = ucwords(strtolower(trim($page_title)));

        return $this;
    }

    /**
     * Get the value of page_slug
     */ 
    public function getPageSlug()
    {
        return $this->page_slug;
    }

    /**
     * Set the value of page_slug
     *
     * @return  self
     */ 
    public function setPageSlug($page_slug)
    {
        $this->page_slug = strtolower(trim(str_replace(' ', '-',$page_slug)));

        return $this;
    }

        /**
     * Get the value of page_content
     */ 
    public function getPageContent()
    {
        return $this->page_content;
    }

    /**
     * Set the value of page_content
     *
     * @return  self
     */ 
    public function setPageContent($page_content)
    {
        $this->page_content = $page_content;

        return $this;
    }

    /**
     * Get the value of page_authorId
     */ 
    public function getPageAuthorId()
    {
        return $this->page_authorId;
    }

    /**
     * Set the value of page_authorId
     *
     * @return  self
     */ 
    public function setPageAuthorId($page_authorId)
    {
        $this->page_authorId = $page_authorId;

        return $this;
    }

    /**
     * Get the value of page_panelId
     */ 
    public function getPage_panelId()
    {
        return $this->page_panelId;
    }

    /**
     * Set the value of page_panelId
     *
     * @return  self
     */ 
    public function setPage_panelId($page_panelId)
    {
        $this->page_panelId = $page_panelId;

        return $this;
    }

    /**
     * Get the value of page_createdAt
     */ 
    public function getPageCreatedAt()
    {
        return $this->page_createdAt;
    }

}