<?php
// Chargement des classes


namespace App\Controller ;

use App\Model\Item;
use App\Model\User;
use App\Model\UserManager;
use App\TestManager;

use App\View;


class Main {


    
    public function loginPage()
    {
        return require('src/View/loginView.php');
    }

    public function newUserPage()
    {
        return require('src/View/newUserView.php');
    }


    public function logUser(){
        $user = new User();
        $checkUser = $user->checkUserLog($_POST['login'], $_POST['pass']);
        if($checkUser){
            $this->listItemPage();
        }
    }

    public function addNewUser(){
        $user = new User();
        $checkUser = $user->createNewUser($_POST['login'], $_POST['mail'], $_POST['pass'], $_POST['pass2']);
        if($checkUser){
            $this->listItemPage();
        }
    }


    public function listItemPage()
    {   
        $Items = new Item();
        $listItems = $Items->getItems();

        require('src/View/listItemsView.php');
    }




    public function addNewItem($itemName, $category, $rate, $review, $user)
    {   
        $Items = new Item();
        $addNewItem = $Items->createItem($itemName, $category, $rate, $review, $user);
        
        
        // $userManager = new UserManager();
       // require('C:\wamp64\www\TP11_online_advisor_phppoo\view\listItemsView.php');

        require('src/View/listItemsView.php');
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
