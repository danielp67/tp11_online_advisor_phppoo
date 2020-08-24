<?php

namespace OpenClassrooms\Blog\Model; // La classe sera dans ce namespace

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM billets  WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;

    }


}