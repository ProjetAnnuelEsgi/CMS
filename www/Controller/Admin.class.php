<?php

namespace App\Controller;

use App\Core\Builders\AbonneBuilder;
use App\Core\Builders\AdminBuilder;
use App\Core\Builders\AuteurBuilder;
use App\Core\Director;
use App\Core\Verificator;
use App\Core\View;
use App\Model\Admin as ModelAdmin;
use App\Model\User;
use stdClass;

class Admin
{

    public function checkUserRole()
    {
        session_start();

        $userRole = $_SESSION['role'];

        switch ($userRole) {
            case '0':
                $userRole = 'Super-Admim';
                break;
            case '1':
                $userRole  = 'Admin';
                break;
            case '2':
                $userRole  = 'Auteur';
                break;
            case '3':
                $userRole = 'Abonné';
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
        session_start();

        $user = new User();
        $auth = new Authenticator();
        $admin = new ModelAdmin();
        $connectedUser = $user->findOne(['id' => $_SESSION['userId']]);

        if (!empty($_POST)) {

            $errors = Verificator::checkForm($user->getAdminCreateUserForm(), $_POST);
            if (count($errors) === 0) {
                extract($_POST);

                $userType = new stdClass();

                switch ($role) {
                    case "1":
                        $userType = new AdminBuilder();
                        break;

                    case '2':
                        $userType = new AuteurBuilder();
                        break;

                    case '3':
                        $userType = new AbonneBuilder();
                        break;

                    default:
                        $userType = new AbonneBuilder();
                        break;
                }


                $director = new Director();
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
        $view->assign("connectedUser", $connectedUser);
    }
}
