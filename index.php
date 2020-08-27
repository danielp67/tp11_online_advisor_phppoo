<?php
session_start();

use App\Controller\CommentController;
use App\Controller\ItemController;
use App\Controller\MainController;
use App\Controller\UserController;

define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));



require "./vendor/autoload.php";

echo date('Y-m-d H:i:s');
$params = explode('/', $_GET['p']);
var_dump($params);


$route = array(
 
    'Main' => new MainController(),
    'Users' => new UserController(), 
    'Items' => new ItemController(),
    'Comments' => new CommentController()
    
    );

try{

    if($params[0] != ""){
        // On sauvegarde le 1er paramètre dans $controller en mettant sa 1ère lettre en majuscule
        $controller = ucfirst($params[0]);
        
        // On sauvegarde le 2ème paramètre dans $action si il existe, sinon index
        $action = isset($params[1]) ? $params[1] : '';

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
    
        $controller = new MainController();
    
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

