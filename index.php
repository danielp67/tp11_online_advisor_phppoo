<?php
define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));

use App\Controller\Controller;
use App\Model\User;
use App\TestManager;


require "./vendor/autoload.php";

echo 'test ';

$params = explode('/', $_GET['p']);

$test = new TestManager();
$test->bonjour();

$controller = new Controller();


$route =[];


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

            /*
            if (isset($_GET['id']) && $_GET['id'] >0 ){
                if(isset($_POST['auteur']) AND isset($_POST['commentaire'])){
                    addComment($_GET['id'], $_POST['auteur'], $_POST['commentaire']);
                }
                else{ // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }

*/
            else { // Autre exception
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
                
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


