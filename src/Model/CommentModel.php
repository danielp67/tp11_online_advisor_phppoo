<?php

namespace App\Model ;

use PDOStatement;

class CommentModel
{   
    private $db;

    public function __construct()
    {  
        $pdo = new ConnectModel();
        $this->db = $pdo->dbConnect();
        
    }

    public function getComments(int $itemId) :PDOStatement
    {
        $comments = $this->db->prepare('SELECT c.id, c.item_id , c.user_idd, c.comment,  DATE_FORMAT(c.date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment, u.id, u.user_login
        FROM comments c INNER JOIN user u ON c.user_idd = u.id
        WHERE c.item_id = ? ORDER BY date_comment');

        $comments->execute(array($itemId));

        return $comments;
    }

    public function createNewComment(array $comment) :bool
    {
        $newComment = $this->db->prepare('INSERT INTO comments (item_id, user_idd, comment, date_comment) VALUES(?, ?, ?, ?)');
        $affectedLines = $newComment->execute(array($comment['itemId'], $comment['userId'], $comment['comment'], $comment['dateCreation']));

        return $affectedLines;
    }



}