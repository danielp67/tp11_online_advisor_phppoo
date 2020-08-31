<?php

namespace App\Model ;

use PDOStatement;

class ItemModel
{
    private $db;

    public function __construct()
    {  
        $pdo = new ConnectModel();
        $this->db = $pdo->dbConnect();
        
    }

    public function createNewItem(array $item) :bool
    {
        $newItem = $this->db->prepare('INSERT INTO items (item_name, category, rate, review, user_idd, date_creation) VALUES(?, ?, ?, ?, ?, ?)');
        $affectedLines = $newItem->execute(array($item['itemName'], $item['category'], $item['rate'], $item['review'], $item['userId'], $item['dateCreation']));

        return $affectedLines;
    }


    public function getItemsDb() :PDOStatement
    {
       
        $req = $this->db->query('SELECT i.id, i.item_name, i.category, i.rate, i.review, i.user_idd, DATE_FORMAT(i.date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation, u.user_login FROM items i INNER JOIN user u ON i.user_idd = u.id ORDER BY date_creation DESC');
        return $req;
    }

    public function getItemDb(string $itemId) :array
    {
        
        $req = $this->db->prepare('SELECT i.id, i.item_name, i.category, i.rate, i.review, i.user_idd, DATE_FORMAT(i.date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation, u.user_login FROM items i INNER JOIN user u ON i.user_idd = u.id  WHERE i.id = ?');
        $req->execute(array($itemId));
        $post = $req->fetch();
        return $post;

    }


}