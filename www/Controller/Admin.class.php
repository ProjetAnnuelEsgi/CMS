<?php

namespace App\Controller;

use App\Core\Builders\AbonneBuilder;
use App\Core\Director;
use App\Core\Verificator;
use App\Core\View;
use App\Model\Admin as ModelAdmin;
use App\Model\User;

class Admin
{

    public function checkUserRole()
    {
        session_start();

        $userRole = $_SESSION['role'];

        switch ($userRole) {
            case '0':
                $userRole = 'Abonné';
                break;
            case '1':
                $userRole  = 'Admin';
                break;
            case '2':
                $userRole  = 'Auteur';
                break;
        }

        return $userRole;
    }

    public function dashboard()
    {
        session_start();

        $user = new User();

        $loggedUser = $user->findOne(['id' => $_SESSION['userId']]);

        $view = new View("dashboard");

        $view->assign('user', $loggedUser);
    }

    public function createUser()
    {
        $user = new User();
        $auth = new Authenticator();
        $admin = new ModelAdmin();

        if (!empty($_POST)) {

            $errors = Verificator::checkForm($user->getAdminCreateUserForm(), $_POST);
            if (count($errors) === 0) {
                extract($_POST);
                $director = new Director();
                $userType = new AbonneBuilder();
                $director->build($userType, $firstname, $lastname, $email, $password);

                $foundUser = $auth->checkIfEmailExist($_POST['email']);

                $admin->setAdminId($_POST['admin_id']);
                $admin->setUserId($foundUser->getId());
                $admin->save();

                if ($foundUser) {
                    $auth->sendActivationEmail($_POST['email'], $foundUser->getActivationCode());
                } else {
                    echo "Votre mail de verification n'a pas été envoyé";
                }


                header("Location: /users");
            } else {
                print_r($errors);
            }
        }

        $view = new View("add-users");
        $view->assign("user", $user);
    }
}
