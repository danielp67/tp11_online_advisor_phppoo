<?php

namespace App\Model ;

use Exception;
use PDO;

class ConnectManager
{
    public function dbConnect()
    {
        try
        {
        // On se connecte à MySQL
        $db = new PDO('mysql:host=localhost;dbname=advisor_db;charset=utf8', 'root', '');
        
                return $db;

        }
        catch(Exception $e)
        {
        // En cas d'erreur, on affiche un message et on arrête tout
                die('Erreur : '.$e->getMessage());
        }
        
    }

}