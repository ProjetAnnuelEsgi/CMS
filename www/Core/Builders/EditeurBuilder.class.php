<?php

namespace App\Core\Builders;

use App\Model\User;

class EditeurBuilder implements Builder
{
  private $user;

  public function createUser()
  {
    $this->user = new User;
  }

  public function createUserFirstname($firstname)
  {
    $this->user->setFirstname($firstname);
  }

  public function createUserLastname($lastname)
  {
    $this->user->setLastname($lastname);
  }

  public function createUserEmail($email)
  {
    $this->user->setEmail($email);
  }

  public function createUserPassword($password)
  {
    $this->user->setPassword($password);
  }

  public function createUserActive()
  {
    $this->user->setActive();
  }

  public function createUserActivationCode()
  {
    $this->user->setActivationCode();
  }

  public function createUserRole($role = 2)
  {
    $this->user->setRole($role);
  }

  public function createPanelId($panelId)
  {
    $this->user->setPanelId($panelId);
  }

  public function saveCreatedUser()
  {
    $this->user->save();
  }

  public function getCreatedUser()
  {
    return $this->user;
  }
}
