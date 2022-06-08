<?php

namespace App\Controller;

use App\Core\View;
use App\Model\User as UserModel;

class User
{
    /** function index pour avoir la liste de tous les users présents en bdd */
    public function index()
    {
        $user = new UserModel();
        $userTable = "esgi_user";
        $users = $user->findAll($userTable);

        $view = new View("viewUsers");
        $view->assign("users", $users);
    }

    /** function show pour avoir un user spécifique */
    public function show()
    {
        $user = new UserModel();
        $userId = $_GET['id'];
        $users = $user->findOne(['id' => $userId]);

        $view = new View("showUser");
        $view->assign("user", $users);
    }

    /** function update pour modifier les informations d'un user spécifique */
    public function edit()
    {
        $user = new UserModel();
        $userId = $_GET['id'];
        $user = $user->findOne(['id' => $userId]);

        $view = new View("editUser");
        $view->assign("user", $user);
    }

    public function update()
    {
        $user = new UserModel();
        $userId = $_GET['id'];
        $user = $user->findOne(['id' => $userId]);
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        $user->setEmail($_POST['email']);

        $user->save();

        header("Location: /user/show?id=$userId");
    }

    /** function delete pour supprimer un user spécifique */
    public function delete()
    {
        $user = new UserModel();
        $userTable = "esgi_user";
        $user->delete($userTable);

        header("Location: /user/index");
    }
}
