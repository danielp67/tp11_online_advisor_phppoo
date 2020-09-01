<?php

namespace App\Controller;

use App\Model\Comment;
use App\Model\CommentModel;

final class CommentController
{
    private $comment;
    private $commentModel;


    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }


    public function addComment(): void
    {
        if ($_SESSION['login'] === null) {
            header('Location: http://localhost/TP11_online_advisor_phppoo');
        }
        $this->comment = new Comment();
        $checkComment = $this->comment->checkNewComment($_POST, $_SESSION);
        $newComment = $this->commentModel->createNewComment($checkComment);

        header('Location: http://localhost/TP11_online_advisor_phppoo/items/getComments/' . $_SESSION['itemId']);
    }
}
