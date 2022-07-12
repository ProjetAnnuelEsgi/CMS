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
                return 'user';
                break;
            case '1':
                return 'admin';
                break;
            case '2':
                return 'author';
                break;
            default:
                '0';
                return 'user';
                break;
        }
    }

    public function dashboard()
    {
        $user = new User();

        $view = new View("dashboard");

        $view->assign('firstname', $user->getFirstname());
    }
}
