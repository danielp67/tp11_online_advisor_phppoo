<?php

namespace App\Model ;

use PDO;

class ConnectManager
{
    public function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=advisor_db;charset=utf8', 'root', '');
        return $db;
    }
}