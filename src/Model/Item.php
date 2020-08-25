<?php

namespace App\Model ;

use PDO;

class Item
{   
    private $itemName;
    private $category;
    private $rate;
    private $review;
    private $userName;
    private $dateCreation;

    public function __construct()
    {
        
    }
    
    public function setMail($mail)
    {
        $pattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
        if (! preg_match ( $pattern , $mail ) ){
            throw new Exception('mail est invalide');
        }
        $this->mail = $mail;

        return $this->mail;
    }

    public function setUserLogin($userLogin)
    {
        $pattern = "/^[a-zA-Z0-9_]{2,16}$/";
        if (! preg_match ($pattern , $userLogin) ){
            throw new Exception('Le pseudo ou login est invalide');
        }
        $this->userLogin = $userLogin;

        return $this->userLogin;
    }

    public function setPass($pass)
    {  
        $pattern = "/^[a-zA-Z0-9_]{6,12}$/";
        if (! preg_match ($pattern , $pass) ){
            throw new Exception('pass est invalide');
        }
        $this->pass = $pass;

        return $this->pass;
    }




}