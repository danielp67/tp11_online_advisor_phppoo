<?php

namespace App\Model ;

use Exception;

class User
{

    private $userLogin;
    private $mail;
    private $pass;
    private $last_login_at;

    public function __construct($userLogin)
    {  
        $this->setUserLogin($userLogin);
    }
    
    //setters
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


    //getters
    public function getUserLogin()
    {
        return $this->userLogin;
    }


    //méthode check log user
    public function checkLogUser($passDb, $passForm)
    {   
        $this->setPass($passDb);

        if($this->pass == $passForm){
                return true;
            }
            else{
                throw new Exception ('Erreur login ou mot de passe');
            }
        
    }



    //méthode check new user
    public function checkNewUser($user)
    {   

        $userLogin = htmlspecialchars($user['login']);
        $mail = htmlspecialchars($user['mail']);
        $pass = htmlspecialchars($user['pass']);
        $pass2 = htmlspecialchars($user['pass2']);
    
        
        if( $this->setMail($mail) && $this->setPass($pass) && $pass === $pass2){

            return $user;
            
             }else
        {
            throw new Exception ('Format incorrect');
        }

    }

}
