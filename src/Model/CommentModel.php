<?php

namespace App\Model ;


class CommentModel
{   
    private $db;

    public function __construct()
    {  
        $pdo = new ConnectModel();
        $this->db = $pdo->dbConnect();
        
    }

    public function getComments($itemId)
    {
       
        $comments = $this->db->prepare('SELECT id, item_id, user, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment FROM comments WHERE item_id = ? ORDER BY date_comment');
        $comments->execute(array($itemId));
        
        return $comments;
    }

    public function createNewComment($comment)
    {
        $newComment = $this->db->prepare('INSERT INTO comments (item_id, user, comment, date_comment) VALUES(?, ?, ?, ?)');
        $affectedLines = $newComment->execute(array($comment['itemId'], $comment['userLogin'], $comment['comment'], $comment['dateCreation']));

        return $affectedLines;
    }



}