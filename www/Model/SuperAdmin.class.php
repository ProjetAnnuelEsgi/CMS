<?php

namespace App\Model;

use App\Core\Sql;

class SuperAdmin extends Sql
{
  protected $id = null;
  protected $superAdmin_id = null;
  protected $admin_id = null;

  public function __construct()
  {

    parent::__construct();
  }

  /**
   * @return null|int
   */
  public function getId(): ?int
  {
    return $this->id;
  }

  /**
   * Get the value of user_id
   */
  public function getSuperAdminId()
  {
    return $this->superAdmin_id;
  }

  /**
   * Set the value of user_id
   *
   * @return  self
   */
  public function setSuperAdminId($superAdmin_id)
  {
    $this->user_id = $superAdmin_id;
  }

  /**
   * Get the value of admin_id
   */
  public function getAdminId()
  {
    return $this->admin_id;
  }

  /**
   * Set the value of admin_id
   *
   * @return  self
   */
  public function setAdminId($admin_id)
  {
    $this->admin_id = $admin_id;
  }
}
