<?php

namespace App\Controller;

use App\Model\User;
use App\Core\Verificator;
use App\Core\View;
use App\Core\Mailer;

class Authenticator
{
  public function sendActivationEmail($email)
  {
    $user = new User();
    $mailer = new Mailer();

    $foundUser = $user->findOne(['email' => $email]);

    if ($foundUser) {
      $mailer->sendActivationEmail($_POST['email'], $foundUser->getActivationCode());
    } else {
      var_dump("Votre mail de verification n'a pas été envoyé");
    }
  }

  public function register()
  {
    $user = new User();
    if (!empty($_POST)) {

      // Je vérifie qu'il les entrées soient corrects
      $errors = Verificator::checkForm($user->getRegisterForm(), $_POST);

      if (count($errors) === 0) {
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setActive();
        $user->setActivationCode();
        $user->save();
        $this->sendActivationEmail($_POST['email']);
        //redirect to login page when registration is successful
        header("location: login");
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

        $loggedUser = $user->attemptLogin($email);
        if ($loggedUser === false) {
          echo  "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }

        if ($loggedUser) {
          if ($loggedUser->getActive() === 0) {
            echo  "Vous n'avez pas encore verifiez votre compte";
          } else {
            $verifyPassword = $loggedUser->decryptPassword($password);
          if ($verifyPassword === false) {
            echo  "Le nom d'utilisateur ou le mot de passe est incorrect.";
          } else {
            $loggedUser->generateToken();
            $loggedUser->save();

            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['userId'] = $loggedUser->getId();
            $_SESSION['firstname'] = $loggedUser->getFirstname();

            header("Location: dashboard");
            }
          }
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

  public function authenticated($connect = false)
  {
    session_start();
    // Set connection to false and verify if user is not already logged in
    if ($connect === false) {
      if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true) {
        header("location: dashboard");
        exit;
      }
    } else {
      if ($_SESSION["loggedIn"] == NULL && $_SESSION["loggedIn"] !== true) {
        header("location: /");
        exit;
      }
    }
  }

  public function verifyAccount() 
  {
    $user = new User();
    $view = new View("verifyaccount");

    $view->assign("user", $user);
  }
}
