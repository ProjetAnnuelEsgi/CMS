<?php

namespace App\Core;

use App\Model\User;

class Director
{
  /**
   *
   * @return App\Model\User
   */
  public function build($builder, $firstname, $lastname, $email, $password, $panelId): User
  {
    $builder->createUser();
    $builder->createUserFirstname($firstname);
    $builder->createUserLastname($lastname);
    $builder->createUserEmail($email);
    $builder->createUserPassword($password);
    $builder->createPanelId($panelId);
    $builder->createUserActive();
    $builder->createUserActivationCode();
    $builder->createUserRole();
    $builder->saveCreatedUser();
    return $builder->getCreatedUser();
  }
}
