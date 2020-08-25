<?php

namespace App\Model ;

require_once("model/Manager.php");

class Comment
{   
    
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=advisor_db;charset=utf8', 'root', '');
        return $db;
    }

    public function getComments($itemId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, item_id, user, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment FROM comments WHERE item_id = ? ORDER BY date_comment');
        $comments->execute(array($itemId));
        
        return $comments;
    }

    public function postComment($itemId, $user, $comment)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('INSERT INTO comments (item_id, user, comment, date_comment) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comment->execute(array($itemId, $user, $comment));

        return $affectedLines;
    }



}