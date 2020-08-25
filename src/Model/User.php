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
        //Ce code n'est pas de la responsibilite de User mais de USerModel
        //$pdo = new ConnectManager();
        //$this->db = $pdo->dbConnect();
        
        $this->setMail($mail);
        
    }
    
    //methode mailcheck d'avant
    public function setMail($mail)
    {
        
        $pattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
        if (! preg_match ( $pattern , $mail ) ){
            throw new Exception('mail est invalide');
        }
        
        $this->mail = $mail;
    }
    
    
    public function userLoginCheck($userLogin)
    {

        $pattern = "/^[a-zA-Z0-9_]{2,16}$/";
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

    //Doit etre deplacé dans UserModel
    public function createNewUser(User $user)
    {
        //ton objet user est ici deja valide, pas besoin de reutiliser checkmail etc....
        
        $userLogin = htmlspecialchars($user->getLogin());
        $mail = htmlspecialchars($user->getMail());
        $pass = htmlspecialchars($pass);
        $pass2 = htmlspecialchars($pass2);
        
        if ($pass === $pass2) && ($this->checkUserExist($userLogin, $mail) == FALSE){
            $newUser =  $this->db->prepare('INSERT INTO user (user_login, mail, pass, last_login_at) VALUES(?, ?, ?, NOW())');
            $affectedLines = $newUser->execute(array($userLogin, $mail, $pass));
            return $affectedLines;
            }
            else
            {
                throw new Exception ('Login ou Mail déjà utilisé');
            }
        }

    }


    public function getUser($userLogin)
    {
        
        $req =  $this->db->prepare('SELECT id, user_login, mail, pass, last_login_at FROM user  WHERE user_login = ?');
        $req->execute(array($userLogin));
        $user = $req->fetch();

        return $user;

    }

    public function checkUserLog($userLogin, $pass)
    {   
        $userLogin = $this->userLoginCheck($userLogin);
        $req = $this->getUser($userLogin);
        if($req){
            $this->mail = $req['mail'];
            $this->pass = $req['pass'];


            if($this->pass == $pass && $this->userLogin === $userLogin){
                return true;
            }
            else{
                throw new Exception ('Erreur login ou mot de passe');
            }
        }
        else{
            throw new Exception ('Erreur login ou mot de passe');
        }

        
        
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
