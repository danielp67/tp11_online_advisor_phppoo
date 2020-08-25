<?php

namespace App\Model ;

require_once("model/Manager.php");

class Item
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=advisor_db;charset=utf8', 'root', '');
        return $db;
    }

    public function createItem($itemName, $category, $rate, $review, $user)
    {
        $db = $this->dbConnect();
        $newItem = $db->prepare('INSERT INTO items (item_name, category, rate, review, user, date_creation) VALUES(?, ?, ?, ?, ?, NOW())');
        $affectedLines = $newItem->execute(array($itemName, $category, $rate, $review, $user));

        return $affectedLines;
    }


    public function getItems()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, item_name, category, rate, review, user, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM items ORDER BY date_creation DESC');
        var_dump($req);
        return $req;
    }

    public function getItem($itemId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, item_name, category, rate, review, user, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM items  WHERE id = ?');
        $req->execute(array($itemId));
        $post = $req->fetch();
        return $post;

    }


}