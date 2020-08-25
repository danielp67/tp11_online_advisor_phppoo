<?php

namespace App\Model ;

use Exception;

class UserModel
{

    private $userLogin;
    private $mail;
    private $pass;
    private $last_login_at;
    private $db;

    public function __construct()
    {  
        $pdo = new ConnectModel();
        $this->db = $pdo->dbConnect();
        
    }

    
    public function checkUserExist($userLogin, $mail)
    {
        
        $reqUser = $this->db->prepare('SELECT id, user_login, mail, pass FROM user  WHERE user_login = ? OR mail = ?');
        $reqUser->execute(array($userLogin,$mail));
        $req = $reqUser->fetch();
     
        if($req){
            return $req;
        }
        else{
            return false;
        }
        
    }


    public function createNewUser($user)
    {
       
            if($this->checkUserExist($user['login'], $user['mail']) == FALSE)
            {
            $newUser =  $this->db->prepare('INSERT INTO user (user_login, mail, pass, last_login_at) VALUES(?, ?, ?, NOW())');
            $affectedLines = $newUser->execute(array($user['login'], $user['mail'], $user['pass']));
            return $affectedLines;
            }
            else
            {
                throw new Exception ('Login ou Mail déjà utilisé');
            }
    }
       

    


    public function getUser($userLogin)
    {
        
        $req =  $this->db->prepare('SELECT id, user_login, mail, pass, last_login_at FROM user  WHERE user_login = ?');
        $req->execute(array($userLogin));
        $user = $req->fetch();

        return $user;

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