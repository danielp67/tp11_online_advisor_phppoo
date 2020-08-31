<?php
// Chargement des classes


namespace App\Controller ;

use App\Model\Comment;
use App\Model\CommentModel;
use App\View;


class CommentController {

    private $comment;
    private $commentModel;


    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }


    public function addComment() :bool
    {      
        if($_SESSION['login'] == NULL){
            header('Location: http://localhost/TP11_online_advisor_phppoo');
        }
        $this->comment = new Comment();
        $checkComment = $this->comment->checkNewComment($_POST, $_SESSION);
        $newComment = $this->commentModel->createNewComment($checkComment);
      
        header('Location: http://localhost/TP11_online_advisor_phppoo/items/getComments/'.$_SESSION['itemId']);

        return true;
    }


}


