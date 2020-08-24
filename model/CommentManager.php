<?php

namespace OpenClassrooms\Blog\Model; // La classe sera dans ce namespace

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }


    public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire FROM commentaires  WHERE id = ?');
        $req->execute(array($commentId));
        $oldComment = $req->fetch();

        return $oldComment;

    }



    public function updateComments($commentId,  $updateComment)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('UPDATE  commentaires SET commentaire= :commentaire WHERE id = :id');
        $comment->execute(array(
            'commentaire' => $updateComment,
            'id' => $commentId  
        ));

        return $comment;
    }
}