<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Verificator;
use App\Model\User as UserModel;
use App\Model\Admin;

class User
{
    /** function index pour avoir la liste de tous les users présents en bdd */
    public function index()
    {
        session_start();

        $admin = new Admin();
        $user = new UserModel();
        // $users = $user->findAll();
        $user = $user->findOne(['id' => $_SESSION['userId']]);

        $foundAdmin = $admin->findOne(['admin_id' => $_SESSION['userId']]);
        $adminUsers = [];

        if ($foundAdmin !== false) {
            $adminUsers = $admin->adminUsers($foundAdmin->getAdminId());
        }

        $view = new View("view-users");
        // $view->assign("users", $users);
        $view->assign("user", $user);
        $view->assign("adminUsers", $adminUsers);
    }

    /** function show pour afficher un user spécifique */
    public function show()
    {
        session_start();

        if (empty($_GET['id'])) {
            header("Location: /users");
        } else {
            $user = new UserModel();
            $admin = new Admin();
            $userId = $_GET['id'];
            $foundAdmin = $admin->findOne(['admin_id' => $userId]);
            $adminUsers = [];

            if ($foundAdmin !== false) {
                $adminUsers = $admin->adminUsers($foundAdmin->getAdminId());
            }

            $user = $user->findOne(['id' => $userId]);
            if ($user === false) {
                header("Location: /users");
            } else {
                $view = new View("show-user");
                $view->assign("user", $user);
                $view->assign("adminUsers", $adminUsers);
            }
        }
    }

    /** vue de update pour afficher les informations d'un user spécifique a modifier*/
    public function edit()
    {
        session_start();
        if (empty($_GET['id'])) {
            header("Location: /users");
        } else {
            $user = new UserModel();
            $userId = $_GET['id'];
            $connectedUser = $user->findOne(['id' => $_SESSION['userId']]);
            $user = $user->findOne(['id' => $userId]);

            if ($user === false) {
                header("Location: /users");
            } else {
                $view = new View("edit-user");
                $view->assign("user", $user);
                $view->assign("connectedUser", $connectedUser);
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
                        $foundUser->setFirstname(strip_tags($_POST['firstname']));
                        $foundUser->setLastname(strip_tags($_POST['lastname']));
                        $foundUser->setRole(($_POST['role']));
                        $foundUser->setEmail($_POST['email']);

                        $foundUser->save();

                        if ($foundUser) {
                            $_SESSION['role'] = $foundUser->getRole();
                            $_SESSION['firstname'] = $foundUser->getFirstname();
                            $_SESSION['lastname'] = $foundUser->getLastname();
                        }

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
