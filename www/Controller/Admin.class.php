<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Admin as ModelAdmin;
use App\Model\User;

class Admin
{

    public function checkUserRole()
    {
    }

    public function dashboard()
    {
        $user = new User();

        $view = new View("dashboard");

        $view->assign('firstname', $user->getFirstname());
    }

    public function createUser()
    {
        $user = new User();
        $auth = new Authenticator();
        $admin = new ModelAdmin();

        if (!empty($_POST)) {

            $errors = Verificator::checkForm($user->getAdminCreateUserForm(), $_POST);
            if (count($errors) === 0) {
                $user->setFirstname($_POST['firstname']);
                $user->setLastname($_POST['lastname']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->setActive();
                $user->setActivationCode();
                $user->save();

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
