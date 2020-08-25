<?php
// Chargement des classes


namespace App\Controller ;

use App\Model\Item;
use App\Model\User;
use App\Model\UserManager;
use App\TestManager;

use App\View;


class Users {

    private $user;
    private $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }
    
    public function loginPage()
    {
        return require('src/View/loginView.php');
    }

    public function newUserPage()
    {
        return require('src/View/newUserView.php');
    }


    public function logUser(){
        $this->user = new User($_POST['login']);
        var_dump($this->user->getUserLogin());
        var_dump($_POST);
        $getUser = $this->userManager->getUser($this->user->getUserLogin());

        var_dump($getUser);
        var_dump($getUser['pass']);
        
        $checkUser = $this->user->checkLogUser($getUser['pass'], $_POST['pass']);

        var_dump($checkUser);
        
        if($checkUser){
            $this->listItemPage();
        }
        
    }


    public function addNewUser(){
        $this->user = new User($_POST['login']);
        $this->user->checkNewUser($_POST);

        $checkUser = $this->user->createNewUser($_POST['login'], $_POST['mail'], $_POST['pass'], $_POST['pass2']);
        if($checkUser){
            $this->listItemPage();
        }
    }



    public function listItemPage()
    {   
        $items = new Item();
        $listItems = $items->getItems();

        require('src/View/listItemsView.php');
    }



/*
    public function addNewItem($itemName, $category, $rate, $review, $user)
    {   
        $Items = new Item();
        $addNewItem = $Items->createItem($itemName, $category, $rate, $review, $user);
       
        require('src/View/listItemsView.php');
    }
*/
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
