<?php
session_start();

use App\Controller\CommentController;
use App\Controller\ItemController;
use App\Controller\MainController;
use App\Controller\UserController;

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require './vendor/autoload.php';

echo date('Y-m-d H:i:s');
$params = explode('/', $_GET['p']);
var_dump($params);


$route = array(

    'Main' => new MainController(),
    'Users' => new UserController(),
    'Items' => new ItemController(),
    'Comments' => new CommentController()

    );

try {
    if ($params[0] !== '') {
        // On sauvegarde le 1er paramètre dans $controller en mettant sa 1ère lettre en majuscule
        $controller = ucfirst($params[0]);

        // On sauvegarde le 2ème paramètre dans $action si il existe, sinon index
        $action = $params[1] ?? '';

        // On appelle le contrôleur

        // On instancie le contrôleur
        $controller = $route[$controller];

        if (method_exists($controller, $action)) {
            // On supprime les 2 premiers paramètres
            unset($params[0]);
            unset($params[1]);

            // On appelle la méthode $action du contrôleur $controller
            call_user_func_array([$controller,$action], $params);
        } else {
            // On envoie le code réponse 404
            http_response_code(404);
            $error = "La page recherchée n'existe pas";
            $controller = new MainController();
            $controller->errorPage($error);
        }
    } else {
        // Ici aucun paramètre n'est défini
        // On instancie le contrôleur

        $controller = new MainController();

        // On appelle la méthode index
        $controller->loginPage();
    }
}
// Si au moins 1 paramètre existe
catch (Exception $error) { // S'il y a eu une erreur, alors...
    $error = $error->getMessage();
    $controller = new MainController();
    $controller->errorPage($error);
}

var_dump($_SESSION);
