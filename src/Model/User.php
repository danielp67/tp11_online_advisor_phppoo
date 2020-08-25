<?php

namespace App\Model ;

use Exception;

class User
{
    const PATTERN_MAIL = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    const PATTERN_USERLOGIN = "/^[a-zA-Z0-9_]{2,16}$/";
    const PATTERN_PASS = "/^[a-zA-Z0-9_]{6,12}$/";
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
        $pattern = self::PATTERN_MAIL;
        if (! preg_match ( $pattern , $mail ) ){
            throw new Exception('mail est invalide');
        }
        $this->mail = $mail;

        return $this->mail;
    }

    public function setUserLogin($userLogin)
    {
        $pattern = self::PATTERN_USERLOGIN;
        if (! preg_match ($pattern , $userLogin) ){
            throw new Exception('Le pseudo ou login est invalide');
        }
        $this->userLogin = $userLogin;

        return $this->userLogin;
    }

    public function setPass($pass)
    {  
        $pattern = self::PATTERN_PASS;
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

        $user['login'] = htmlspecialchars($user['login']);
        $user['mail'] = htmlspecialchars($user['mail']);
        $user['pass'] = htmlspecialchars($user['pass']);
        $user['pass2'] = htmlspecialchars($user['pass2']);
    
        
        if( $this->setMail($user['mail']) && $this->setPass($user['pass']) && $user['pass'] === $user['pass2']){

            return $user;
            
             }else
        {
            throw new Exception ('Format incorrect');
        }

    }

}
