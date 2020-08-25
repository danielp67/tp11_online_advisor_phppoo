<?php

namespace App\Model ;



class Item
{
    private $db;

    public function __construct()
    {  
        $pdo = new ConnectManager();
        $this->db = $pdo->dbConnect();
        
    }

    public function createItem($itemName, $category, $rate, $review, $user)
    {
        
        $newItem = $this->db->prepare('INSERT INTO items (item_name, category, rate, review, user, date_creation) VALUES(?, ?, ?, ?, ?, NOW())');
        $affectedLines = $newItem->execute(array($itemName, $category, $rate, $review, $user));

        return $affectedLines;
    }


    public function getItems()
    {
       
        $req = $this->db->query('SELECT id, item_name, category, rate, review, user, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM items ORDER BY date_creation DESC');
        var_dump($req);
        return $req;
    }

    public function getItem($itemId)
    {
        
        $req = $this->db->prepare('SELECT id, item_name, category, rate, review, user, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM items  WHERE id = ?');
        $req->execute(array($itemId));
        $post = $req->fetch();
        return $post;

    }


}