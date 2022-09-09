<?php

namespace App;

use App\Core\Router;

$file =  "conf.inc.php";

function myAutoloader($class)
{
    $class = str_replace("App\\", "", $class);
    $class = str_replace("\\", "/", $class);
    if (file_exists($class . ".class.php")) {
        include $class . ".class.php";
    }
}

spl_autoload_register("App\myAutoloader");



//Réussir à récupérer l'URI
$uri = $_SERVER["REQUEST_URI"];

$routeFile = "routes.yml";
if (!file_exists($routeFile)) {
    die("Le fichier " . $routeFile . " n'existe pas");
}

$routes = yaml_parse_file($routeFile);

$router = new Router();

if (file_exists($file)) {
    require $file;

    if ($uri == "/installer" || $uri == "/checkData") {
        header("location: /");
    };

    if ((empty($routes[$uri]) ||  empty($routes[$uri]["controller"]) ||  empty($routes[$uri]["action"])) && empty($_GET)) {
        if ($router->getPages($uri) !== false) {
            $uri = $router->getPages($uri);
        } elseif ($router->getArticles($uri) !== false) {
            $uri = $router->getArticles($uri);
        } else {
            die("Erreur 404! Cette page n'existe pas.");
        }
    }

    $uri = explode('?', $uri)[0];

    $controller = ucfirst(strtolower($routes[$uri]["controller"]));
    $action = strtolower($routes[$uri]["action"]);
} else if (isset($_POST) && count($_POST) == 6) {
    $controller = "Installer";
    $action = "checkData";
} else {
    $controller = "Installer";
    $action = "install";
}

/*
 *
 *  Vérfification de la sécurité, est-ce que la route possède le paramètr security
 *  
 *
 */


$controllerFile = "Controller/" . $controller . ".class.php";
if (!file_exists($controllerFile)) {
    die("Le controller " . $controllerFile . " n'existe pas");
}
//Dans l'idée on doit faire un require parce vital au fonctionnement
//Mais comme on fait vérification avant du fichier le include est plus rapide a executer
include $controllerFile;

$controller = "App\\Controller\\" . $controller;
if (!class_exists($controller)) {
    die("La classe " . $controller . " n'existe pas");
}
// $controller = User ou $controller = Global
$objectController = new $controller();

if (!method_exists($objectController, $action)) {
    die("L'action " . $action . " n'existe pas");
}
// $action = login ou logout ou register ou home
$objectController->$action();
