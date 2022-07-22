<?php

namespace App\Core\Builders;


interface Builder
{

  public function createUser();

  public function createUserFirstname($firstname);

  public function createUserLastname($lastname);

  public function createUserEmail($email);

  public function createUserPassword($password);

  public function createUserActive();

  public function createUserActivationCode();

  public function createUserRole($role);

  public function saveCreatedUser();

  public function getCreatedUser();
}
