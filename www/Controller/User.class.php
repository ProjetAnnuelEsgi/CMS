<?php

namespace App\Controller;

use App\Core\Authenticator;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;

class User
{
    public function login()
    {
        $user = new UserModel();
        $view = new View("login");
        $view->assign("user", $user);

        if (!empty($_POST)) {
            // TO DO create a find
            extract($_POST);
            $errors = Verificator::checkForm($user->getLoginForm(), $_POST);
            if (count($errors) == 0) {
                $auth = new Authenticator();
                $auth->login($_POST);
            }
        }
    }


    public function register()
    {

        $user = new UserModel();

        if (!empty($_POST)) {

            $result = Verificator::checkForm($user->getRegisterForm(), $_POST);
            print_r($result);
        }

        $view = new View("register");
        $view->assign("user", $user);
    }


    public function logout()
    {
        $auth = new Authenticator();

        $view = new View("logout");
        $view->assign("auth", $auth);
    }


    public function pwdforget()
    {
        echo "Mot de passe oublié";
    }
}
