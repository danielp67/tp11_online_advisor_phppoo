<?php

use App\Controller\HomeController;
use App\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

require __DIR__.'/vendor/autoload.php';

$session = new Session();
$session->start();

//session_start();

echo date('Y-m-d H:i:s');
$params = explode('/', $_GET['url']);
var_dump($params);
/*
$request = new Request();
$request2 = Request::createFromGlobals();

var_dump($request);
var_dump($request2);
*/

    $router = new Router($_GET['url']);


    $router->get('home/loginPage', 'Home.loginPage');
    $router->get('home/newUserPage', 'Home.newUserPage');
    $router->get('/', 'Home.loginPage');


    $router->post('user/logUser', 'User.logUser');
    $router->post('user/addNewUser', 'User.addNewUser');

    $router->get('item/listItemPage', 'Item.listItemPage');
    $router->post('item/addNewItem', 'Item.addNewItem');


    $router->get('item/getComments/:id', 'Item.getComments');
    $router->post('comment/addComment/:id', 'Comment.addComment');


    $router->get('user/sessionDestroy', 'User.sessionDestroy');

    $router->get('home/errorPage', 'Home.errorPage');


try {
    $router->run();

}
catch (Exception $error) { 

        $controller = new HomeController();
        $controller->errorPage($error);
}


/*

$route = array(

    'Home' => new HomeController(),
    'User' => new UserController(),
    'Item' => new ItemController(),
    'Comment' => new CommentController()

    );

try {
    if ($params[0] !== '') {
        // On sauvegarde le 1er paramètre dans $controller en mettant sa 1ère lettre en majuscule
        $controller = ucfirst($params[0]);

        // On sauvegarde le 2ème paramètre dans $action si il existe, sinon index
        $action = $params[1] ?? '';

        // On appelle le contrôleur
        //$controller = $controller."Controller";
        //echo $controller;
        //$controller = new $controller();
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
            $controller = new HomeController();
            $controller->errorPage($error);
        }
    } else {
        // Ici aucun paramètre n'est défini
        // On instancie le contrôleur

        $controller = new HomeController();

        // On appelle la méthode index
        $controller->loginPage();
    }
}
// Si au moins 1 paramètre existe
catch (Exception $error) { // S'il y a eu une erreur, alors...
    $error = $error->getMessage();
    $controller = new HomeController();
    $controller->errorPage($error);
}
*/


var_dump($session->get('login'));
var_dump($session->all());