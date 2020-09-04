<?php

namespace App\Model;

final class CommentModel
{
    private object $dataBase;

    public function __construct()
    {
        $pdo = new ConnectModel();
        $this->dataBase = $pdo->dbConnect();
    }

    public function getComments(int $itemId): array
    {
        $getComments = $this->dataBase->prepare('SELECT 
        c.id, c.item_id , c.user_idd, c.comment,  
        DATE_FORMAT(c.date_comment, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS date_comment, u.id, u.user_login
        FROM comments c INNER JOIN user u ON c.user_idd = u.id
        WHERE c.item_id = ? ORDER BY date_comment');

        $getComments->execute(array($itemId));

        return $getComments->fetchAll();
    }

    public function createNewComment(array $comment): bool
    {
        $newComment = $this->dataBase->prepare('INSERT INTO 
        comments (item_id, user_idd, comment, date_comment) 
        VALUES(?, ?, ?, ?)');

        return $newComment->execute(array($comment['itemId'],
        $comment['userId'], $comment['comment'], $comment['dateCreation']));
    }
}
