<?php

namespace App\Controller;

use App\Model\User;
use App\Core\Verificator;
use App\Core\View;

class Authenticator
{
  public function register()
  {
    $user = new User();
    if (!empty($_POST)) {

      //Je vérifie qu'il les entrées soient corrects
      $errors = Verificator::checkForm($user->getRegisterForm(), $_POST);
      if (count($errors) === 0) {

        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->save();
      } else {
        print_r($errors);
      }
    }

    $view = new View("register");
    $view->assign("user", $user);
  }

  public function login()
  {

    $user = new User();
    $view = new View("login");
    $view->assign("user", $user);

    if (!empty($_POST)) {
      // TO DO create a find
      extract($_POST);
      $errors = Verificator::checkForm($user->getLoginForm(), $_POST);
      if (count($errors) == 0) {

        extract($_POST);

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
    }
  }

  public function logout()
  {
    new View("logout");
    session_start();
    session_destroy();
  }

  public function pwdforget()
  {
    echo "Mot de passe oublié";
  }
}
