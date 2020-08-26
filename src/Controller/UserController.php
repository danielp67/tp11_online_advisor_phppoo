<?php
// Chargement des classes


namespace App\Controller ;

use App\Model\Item;
use App\Model\User;
use App\Model\UserModel;

use App\View;


class UserController {

    private $user;
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    
    public function loginPage()
    {
        return require('src/View/loginView.php');
    }

    public function newUserPage()
    {
        return require('src/View/newUserView.php');
    }


    public function logUser()
    {
        $this->user = new User($_POST['login']);
        $userLogin = $this->user->getUserLogin();
        
        var_dump($_POST);
        $getUserDb = $this->userModel->getUserDb($userLogin);

        var_dump($getUserDb);

        $checkUser = $this->user->checkLogUser($getUserDb, $_POST['pass']);
        $getUserDb = $this->user->getUser();
        var_dump($checkUser);
        var_dump($getUserDb);
        if($checkUser){
            $this->userModel->updateUserDateLog($getUserDb);
            $this->callItemController($getUserDb);
        }
        
    }


    public function addNewUser()
    {
        $this->user = new User($_POST['login']);
        $newUser = $this->user->checkNewUser($_POST);

        $checkUser = $this->userModel->createNewUser($newUser);
        if($checkUser){
            $this->callItemController($newUser);
        }
    }



    public function callItemController($user)
    {   
       
      //  header('Location: http://localhost/TP11_online_advisor_phppoo/items/listItemPage/'.$user['login']);
        $itemList = new ItemController();
        $itemList->mainItemPage($user);

        

    
    }


}














/*
function listPosts()
{
    $postManager = new OpenClassrooms\Blog\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('C:\wamp64\www\16.1_Web test\PHP et SQL\03_tp_blog\view\frontend\listPostsView.php');
}



function post()
{
    $postManager = new OpenClassrooms\Blog\Model\PostManager(); // Création d'un objet
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $post = $postManager->getPost($_GET['id']); // Appel d'une fonction de cet objet
    $comments = $commentManager->getComments($_GET['id']);
   
    require('C:\wamp64\www\16.1_Web test\PHP et SQL\03_tp_blog\view\frontend\postView.php');

}



function addComment($postId, $author, $comment){

    $commentManager = new OpenClassrooms\Blog\Model\CommentManager(); // Création d'un objet
    $insert_comments =  $commentManager->postComment($postId, $author, $comment);

    if($insert_comments === false){

        throw new Exception('Impossible d\'ajouter le commentaire !');
        
    }
    else{
        header('Location:index.php?action=post&id=' .$postId);
    }


}


function modifyComment(){
    $commentManager= new OpenClassrooms\Blog\Model\CommentManager();
    $modify_comment =  $commentManager->getComment($_GET['id']);

    
    require('C:\wamp64\www\16.1_Web test\PHP et SQL\03_tp_blog\view\frontend\commentView.php');

}



function updateComment($commentId,$newComment){
    $commentManager= new OpenClassrooms\Blog\Model\CommentManager();
    $modify_comment =  $commentManager->updateComments($commentId,$newComment);

    if($modify_comment === false){

        throw new Exception('Impossible d\'ajouter le commentaire !');
        
    }
    else{
        header('Location:index.php?action=post&id=' .$_GET['id_billet']);
    }
}

*/
