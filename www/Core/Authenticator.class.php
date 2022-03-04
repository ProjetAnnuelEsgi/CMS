<?php

namespace App\Core;

use App\Model\User;

class Authenticator
{
  public function __construct()
  {
  }

  public function login($request)
  {
    extract($request);

    $user = new User();

    $user = $user->findOne(['email' => $email]);

    if ($user === false) {
      echo  "Le nom d'utilisateur ou le mot de passe est incorrect.";
    } else {

      $p = $user->decryptPassword($password);
      if ($p === false) {
        echo  "Le nom d'utilisateur ou le mot de passe est incorrect.";
      }
      $user->generateToken();
      $user->save();
      session_start();

      $_SESSION['loggedIn'] = true;
      $_SESSION['firstname'] = $user->getFirstname();
      header("Location: dashboard");
    }
  }

  public function logout()
  {
    session_start();
    session_destroy();
  }
}
