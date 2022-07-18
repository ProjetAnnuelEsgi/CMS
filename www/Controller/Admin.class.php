<?php

namespace App\Controller;

use App\Core\View;
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
}
