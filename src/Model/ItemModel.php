<?php

namespace App\Model;

use PDOStatement;

final class ItemModel
{
    private object $dataBase;

    public function __construct()
    {
        $pdo = new ConnectModel();
        $this->dataBase = $pdo->dbConnect();
    }

    public function createNewItem(array $item): bool
    {
        $newItem = $this->dataBase->prepare('INSERT INTO 
        items (item_name, category, rate, review, user_idd, date_creation)
        VALUES(?, ?, ?, ?, ?, ?)');
        return $newItem->execute(array($item['itemName'], $item['category'],
        $item['rate'], $item['review'], $item['userId'], $item['dateCreation']
        ));
    }

    public function getItemsDb(): PDOStatement
    {
        return $this->dataBase->query('SELECT 
        i.id, i.item_name, i.category, i.rate, i.review, i.user_idd, 
        DATE_FORMAT(i.date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS date_creation, u.user_login 
        FROM items i INNER JOIN user u ON i.user_idd = u.id 
        ORDER BY i.date_creation DESC');
    }

    public function getItemDb(string $itemId): array
    {
        $req = $this->dataBase->prepare('SELECT 
        i.id, i.item_name, i.category, i.rate, i.review, i.user_idd, 
        DATE_FORMAT(i.date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS date_creation, u.user_login 
        FROM items i INNER JOIN user u ON i.user_idd = u.id  
        WHERE i.id = ?');
        $req->execute(array($itemId));
        return $req->fetch();
    }
}
