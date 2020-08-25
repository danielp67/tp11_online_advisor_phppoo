<?php
// Chargement des classes


namespace App\Controller ;

use App\Model\Comment;
use App\Model\Item;


use App\View;


class Items {

    
    public function listItemPage()
    {   
        $items = new Item();
        $listItems = $items->getItems();

        require('src/View/listItemsView.php');
    }


 public function getComments()
    {
        $item = new Item();
        $params = explode('/', $_GET['p']);
        $comments = new Comment();
        $getComments = $comments->getComments($params[2]);
        
        $getItem = $item->getItem($params[2]);
        require('src/View/itemView.php');
         
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
