<?php

namespace App\Model ;

use Exception;

class UserModel
{

    private $db;

    public function __construct()
    {  
        $pdo = new ConnectModel();
        $this->db = $pdo->dbConnect();
        
    }

    
    public function checkUserExist(string $userLogin, string $mail) :bool
    {
        
        $req = $this->db->prepare('SELECT id, user_login, mail, pass FROM user  WHERE user_login = ? OR mail = ?');
        $req->execute(array($userLogin,$mail));
        $post = $req->fetch();
     
        if($post){
            return true;
        }
        else{
            return false;
        }
        
    }


    public function createNewUser(array $user) :bool
    {
       
        if($this->checkUserExist($user['login'], $user['mail']) == FALSE)
        {
            $newUser =  $this->db->prepare('INSERT INTO user (user_login, mail, pass, last_login_at) VALUES(?, ?, ?, ?)');
            $affectedLines = $newUser->execute(array($user['login'], $user['mail'], $user['pass'], $user['lastLoginAt']));
            
            return $affectedLines;

        }
        else
        {
            throw new Exception ('Login ou Mail déjà utilisé');
        }
    }
       

    


    public function getUserDb(string $userLogin) :array
    {
        
        $req =  $this->db->prepare('SELECT id, user_login, mail, pass, last_login_at FROM user  WHERE user_login = ?');
        $req->execute(array($userLogin));
        $user = $req->fetch();

        if($user){
            return $user;
        }
        else{
           
        throw new Exception ('Login inexistant');
        }
    }

  

    public function updateUserDateLog(array $user) :bool
    {
        $req =  $this->db->prepare('UPDATE user SET last_login_at = ? WHERE user_login = ?');
        $req->execute(array($user['lastLoginAt'], $user['login']));
        $post = $req->fetch();

        return $post;
    }


    public function deleteUser(string $userLogin) :bool
    {
        $req =  $this->db->prepare('DELETE FROM item  WHERE id = ?');
        $req->execute(array($userLogin));
        $post = $req->fetch();

        return $post;
    }
    

}