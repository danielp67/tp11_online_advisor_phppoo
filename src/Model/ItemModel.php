<?php

namespace App\Model ;



class ItemModel
{
    private $db;

    public function __construct()
    {  
        $pdo = new ConnectModel();
        $this->db = $pdo->dbConnect();
        
    }

    public function createNewItem($item)
    {
        $newItem = $this->db->prepare('INSERT INTO items (item_name, category, rate, review, user, date_creation) VALUES(?, ?, ?, ?, ?, ?)');
        $affectedLines = $newItem->execute(array($item['itemName'], $item['category'], $item['rate'], $item['review'], $item['userLogin'], $item['dateCreation']));

        return $affectedLines;
    }


    public function getItemsDb()
    {
       
        $req = $this->db->query('SELECT id, item_name, category, rate, review, user, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM items ORDER BY date_creation DESC');
        return $req;
    }

    public function getItemDb($itemId)
    {
        
        $req = $this->db->prepare('SELECT id, item_name, category, rate, review, user, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM items  WHERE id = ?');
        $req->execute(array($itemId));
        $post = $req->fetch();
        return $post;

    }


}