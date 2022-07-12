<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Mailer;
use App\Model\User as UserModel;

class User
{
    /** function index pour avoir la liste de tous les users présents en bdd */
    public function index()
    {
        $user = new UserModel();
        $users = $user->findAll();

        $view = new View("viewUsers");
        $view->assign("users", $users);
    }

    /** function show pour afficher un user spécifique */
    public function show()
    {
        if (empty($_GET['id'])) {
            header("Location: /users");
        } else {
            $user = new UserModel();
            $userId = $_GET['id'];
            $user = $user->findOne(['id' => $userId]);
            if ($user === false) {
                header("Location: /users");
            } else {
                $view = new View("showUser");
                $view->assign("user", $user);
            }
        }
    }

    /** vue de update pour afficher les informations d'un user spécifique a modifier*/
    public function edit()
    {
        if (empty($_GET['id'])) {
            header("Location: /users");
        } else {
            $user = new UserModel();
            $userId = $_GET['id'];
            $user = $user->findOne(['id' => $userId]);

            if ($user === false) {
                header("Location: /users");
            } else {
                $view = new View("editUser");
                $view->assign("user", $user);
            }
        }
    }

    /** function update pour modifier les informations d'un user spécifique */
    public function update()
    {
        if (empty($_GET['id'])) {
            header("Location: /users");
        } 
        else 
        {
            $user = new UserModel();
            $userId = $_GET['id'];
            $user = $user->findOne(['id' => $userId]);

            if ($user === false) {
                header("Location: /users");
            } else {
                $user = new UserModel();
                if (!empty($_POST)) {

                    //Je vérifie qu'il les entrées soient corrects
                    $errors = Verificator::checkForm($user->getRegisterForm(), $_POST);
                    if (count($errors) === 0) {

                        $user->setFirstname($_POST['firstname']);
                        $user->setLastname($_POST['lastname']);
                        $user->setEmail($_POST['email']);

                        $user->save();

                        header("Location: /user/show?id=$userId");
                        
                    } else {
                        print_r($errors);
                    }
                    
                }
            $view = new View("register");
            $view->assign("user", $user);
            }
        }
    }
        

    /** function delete pour supprimer un user spécifique */
    public function delete()
    {
        $user = new UserModel();
        $userId = $_GET['id'];
        $user->delete($userId);

        header("Location: /users");
    }
}

