<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Verificator;
use App\Model\User as UserModel;

class User
{
    /** function index pour avoir la liste de tous les users présents en bdd */
    public function index()
    {
        $user = new UserModel();
        $users = $user->findAll();

        $view = new View("view-users");
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
                $view = new View("show-user");
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
                $view = new View("edit-user");
                $view->assign("user", $user);
            }
        }
    }

    /** function update pour modifier les informations d'un user spécifique */
    public function update()
    {
        if (empty($_GET['id'])) {
            header("Location: /users");
        } else {
            $user = new UserModel();
            $userId = $_GET['id'];
            $foundUser = $user->findOne(['id' => $userId]);

            if ($foundUser === false) {
                header("Location: /users");
            } else {
                if (!empty($_POST)) {
                    //Je vérifie qu'il les entrées soient corrects
                    $errors = Verificator::checkForm($user->getUpdateUserForm(), $_POST);
                    if (count($errors) === 0) {
                        $foundUser->setFirstname(strip_tags(htmlentities($_POST['firstname'])));
                        $foundUser->setLastname(strip_tags(htmlentities($_POST['lastname'])));
                        $foundUser->setEmail(strip_tags(htmlentities($_POST['email'])));

                        $foundUser->save();

                        header("Location: /user/show?id=$userId");
                    } else {
                        echo "<script>";
                        echo " alert('$errors[0]');        
                            window.location.href='/user/edit?id=$userId';
                         </script>";
                    }
                }
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
