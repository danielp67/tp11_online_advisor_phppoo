<?php

namespace App\Model ;

use Exception;

class User
{

    private $userLogin;
    private $mail;
    private $pass;
    private $last_login_at;
    private $db;

    public function __construct($userLogin, $mail, $pass)
    {   
        $pdo = new ConnectManager();
       $this->db = $pdo->dbConnect();
       $this->mailCheck($mail);
       $this->userLoginCheck($userLogin);
       $this->passCheck($pass);
        
    }

    public function mailCheck($mail)
    {
        
        $pattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
        if ( preg_match ( $pattern , $mail ) )
        {
        echo "L'adresse eMail est valide";
        return $this->mail = $mail;
        }
        else 
        {
        throw new Exception('mail est invalide');
        }
    }
    
    
    public function userLoginCheck($userLogin)
    {
        $pattern = "/^[a-zA-Z0-9_]{3,16}$/";
        if ( preg_match ($pattern , $userLogin) )
        {
        echo "Le pseudo ou login est valide";
        return $this->userLogin = $userLogin;
        }
        else 
        {
        throw new Exception('userLogin est invalide');
        }
    }

    public function passCheck($pass)
    {
        $pattern = "/^[a-zA-Z0-9_]{6,12}$/";
        if ( preg_match ($pattern , $pass) )
        {
        echo "Le pseudo ou login est valide";
        return $this->pass = $pass;
        }
        else 
        {
        throw new Exception('pass est invalide');
        }
    }


    public function checkUserExist($userLogin, $mail)
    {
        
        $reqUser = $this->db->prepare('SELECT id, user_login, mail FROM user  WHERE user_login = ? OR mail = ?');
        $reqUser->execute(array($userLogin,$mail));
        $req = $reqUser->fetch();
     
        if($req){
            return true;
        }
        else{
            return false;
        }
        
    }


    public function createNewUser($userLogin, $mail, $pass)
    {
       
        $newUser =  $this->db->prepare('INSERT INTO user (user_login, mail, pass, last_login_at) VALUES(?, ?, ?, NOW())');
        $affectedLines = $newUser->execute(array($userLogin, $mail, $pass));
        return $affectedLines;
    }


    public function getUser($userLogin)
    {
        
        $req =  $this->db->prepare('SELECT id, user_login, mail, pass, last_login_at FROM user  WHERE user_login = ?');
        $req->execute(array($userLogin));
        $post = $req->fetch();

        return $post;

    }

    public function updateUserDateLog($userLogin)
    {
        $req =  $this->db->prepare('UPDATE user SET last_login_at = NOW() WHERE user_login = ?');
        $req->execute(array($userLogin));
        $post = $req->fetch();

        return $post;
    }


    public function deleteUser($userLogin)
    {
        $req =  $this->db->prepare('DELETE FROM item  WHERE id = ?');
        $req->execute(array($userLogin));
        $post = $req->fetch();

        return $post;
    }
    

}