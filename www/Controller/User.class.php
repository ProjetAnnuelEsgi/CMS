<?php
namespace App\Controller;

use App\Core\CleanWords;
use App\Core\Sql;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;

class User extends Sql{

    public function login()
    {
        $view = new View("Login");

        $view->assign("pseudo", "Prof");
        $view->assign("firstname", "Yves");
        $view->assign("lastname", "Skrzypczyk");

    }


    public function register()
    {

        $user = new UserModel();
        if( !empty($_POST)){
            
            
            $result = Verificator::checkForm($user->getRegisterForm(), $_POST); //Je vérifie qu'il les entrées soient corrects
            
            //$firstname = $this->setFirstname($_POST['']);
            //$lastname = $this->setLastname($_POST['']);
            //var_dump($_POST);
            //die;
            // $user->setFirstname($_POST['firstname']);
            // $user->setLastname($_POST['lastname']);
            // $user->setPassword($_POST['password']);
            // $user->save();
   
        }

        $view = new View("register");
        $view->assign("user", $user);
    }


    public function logout()
    {
        echo "Se déco";
    }


    public function pwdforget()
    {
        echo "Mot de passe oublié";
    }

}





