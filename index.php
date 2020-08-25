<?php

use App\Controller\Items;
use App\Controller\Main;
use App\Controller\Users;

define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));


require "./vendor/autoload.php";

echo 'test ';

$params = explode('/', $_GET['p']);
var_dump($params);
$controller = ucfirst($params[0]);
echo $controller;

$route = array(
 
    'Main' => new Main(),
    'Users' => new Users(), 
    'Items' => new Items()
    
    );

try{

    if($params[0] != ""){
        // On sauvegarde le 1er paramètre dans $controller en mettant sa 1ère lettre en majuscule
        $controller = ucfirst($params[0]);
        
        // On sauvegarde le 2ème paramètre dans $action si il existe, sinon index
        $action = isset($params[1]) ? $params[1] : '';
        echo $controller;
        echo $action;
        // On appelle le contrôleur
        
        // On instancie le contrôleur
        $controller = $route[$controller];
       
        var_dump($controller) ;
        if(method_exists($controller, $action)){
            // On supprime les 2 premiers paramètres
            echo 'vrai';
            unset($params[0]);
            unset($params[1]);
    
            // On appelle la méthode $action du contrôleur $controller
            call_user_func_array([$controller,$action], $params);
    
        }else{
            // On envoie le code réponse 404
            http_response_code(404);
            echo "La page recherchée n'existe pas";
        }

    }else{
        // Ici aucun paramètre n'est défini
        // On instancie le contrôleur
    
        $controller = new Main();
    
        // On appelle la méthode index
        $controller->loginPage();
    }

}
// Si au moins 1 paramètre existe
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}









/*


try{


    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'loginPage') {
            $controller->loginUserPage();
        }
        elseif ($_GET['page'] == 'newUserPage') {
            
            $controller->newUserPage();
          
        }
    }
    elseif (isset($_GET['action'])) {
            if ($_GET['action'] == 'loginUser') {
                $controller->loginUser();
            }

                
        }
       
    else {
        echo 'test du controller';
        $userLogin ='Username';
        $mail = 'monemail';
        $pass='passmail';
        $controller->loginUserPage();
        $newUser = new User($userLogin, $mail, $pass);
        $newUser->checkUserExist($userLogin, $mail);
        $newUser->createNewUser($userLogin, $mail, $pass);
        $newUser->updateUserDateLog($userLogin);

    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
*/

