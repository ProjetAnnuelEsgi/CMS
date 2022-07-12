<?php

namespace App\Controller;

use App\Model\User;
use App\Core\Verificator;
use App\Core\View;
use App\Core\Mailer;

class Authenticator extends Mailer
{
  public function checkIfEmailExist($email)
  {
    $user = new User();
    $foundUser = $user->findOne(['email' => $email]);
    
    return $foundUser;
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
        $foundUser = $this->checkIfEmailExist($_POST['email']);
        if ($foundUser) {
          $this->sendActivationEmail($_POST['email'], $foundUser->getActivationCode());
        } else {
          echo "Votre mail de verification n'a pas été envoyé";
        }
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
    if (isset($_POST['forget']) && isset($_POST['email'])) 
    {
        $message = '';
        $foundUser = $this->checkIfEmailExist($_POST['email']);

        if ($foundUser === false) 
        {
            $message = "L\'email n\'existe pas";
            // echo "<script>"; 
            // echo "alert('$message');        
            // window.location.href='showpwd';
            // </script>";
        }   
        else 
        {
            $token = md5($foundUser->getEmail()).rand(10,9999);
            $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
            $expDate = date("Y-m-d H:i:s",$expFormat);

            $this->sendForgotPasswordEmail($_POST['email'], $token);
            
            $foundUser->setResetLinkToken($_POST['email'], $token);
            $foundUser->setActivationExpiry($expDate);
            
            $foundUser->save();

            $message = "Un email à été envoyé, Veuillez vérifier votre messagerie."; 
          }
          echo "<script>"; 
          echo " alert('$message');        
          window.location.href='showpwd';
                </script>";
    }
         
  }

  public function setPwd()
  {
    $user = new User();
    if(isset($_POST['password']) && $_POST['reset_link_token'] && $_POST['email'])
    {
      $message = '';
      $email = $_POST['email'];
      $token = $_POST['reset_link_token'];
      $password = $_POST['password'];
      
      $foundUser = $user->findOne(['email'=>$email]);
      if(!empty($foundUser))
      {
      $foundUser->setPassword($password);
      $foundUser->save();
      
      $message = "Congratulations! Your password has been updated successfully.";
      // echo '<p>Congratulations! Your password has been updated successfully.</p>';
      }
      else
      {
        $message = "Something goes wrong. Please try again";
      // echo "<p>Something goes wrong. Please try again</p>";
      }
      echo "<script>"; 
          echo " alert('$message');        
          window.location.href='showpwd';
                </script>";
    }
  }

  public function showPwdForget()
  {
    $view = new View("forgotpassword");
  }

  public function resetPwd()
  {
    $verificator = new Verificator();
    $user = new User();
    $view = new View("resetpwd");

    $view->assign("user", $user);
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
// $update = mysqli_query($conn,"UPDATE users set  password='" . $password . "', reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE email='" . $emailId . "'");
 
// $link = "<a href='www.yourwebsite.com/res/t-password.php?key=".$emailId."&token=".$token."'>Click To Reset password</a>";