<?php

namespace App\Model;

use App\Core\Sql;

class Menu extends Sql

{
    protected $id = null;
    protected $show = 0;
    protected $page_id = null;
    protected $menu_panelId = null;
    	
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
     * Get the value of show
     */ 
    public function getShow()
    {
        return $this->show;
    }

    /**
     * Set the value of show
     *
     * @return  self
     */ 
    public function setShow($show)
    {
        $this->show = $show;

        return $this;
    }

    /**
     * Get the value of page_id
     */ 
    public function getPageId()
    {
        return $this->page_id;
    }

    /**
     * Set the value of page_id
     *
     * @return  self
     */ 
    public function setPageId($page_id)
    {
        $this->page_id = $page_id;

        return $this;
    }

    /**
     * Get the value of menu_panelId
     */ 
    public function getMenu_panelId()
    {
        return $this->menu_panelId;
    }

    /**
     * Set the value of menu_panelId
     *
     * @return  self
     */ 
    public function setMenu_panelId($menu_panelId)
    {
        $this->menu_panelId = $menu_panelId;

        return $this;
    }
}