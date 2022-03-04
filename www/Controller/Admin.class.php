<?php

namespace App\Controller;

use App\Core\View;
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
}
