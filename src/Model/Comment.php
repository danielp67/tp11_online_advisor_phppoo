<?php

namespace App\Model ;

use Exception;

class Comment
{   
    const PATTERN_COMMENT = "/^(\w[ -.,!?]*){2,255}$/";
    const PATTERN_USERLOGIN = "/^[a-zA-Z0-9_]{2,16}$/";
    private int $itemId=0;
    private string $comment ='';
    private string $userLogin='';
    private string $dateCreation='';

 
    public function __construct()
    {
        $this->setDateCreation();
    }

    public function setItemId(int $itemId) :int
    {
        if(!is_int($itemId) || $itemId<1){
        throw new Exception('Item Id invalide');
    }
        $this->itemId = $itemId;
        
        return $this->itemId;
    }


    public function setComment(string $comment) :string
    {
        $pattern = self::PATTERN_COMMENT;
        if (! preg_match ($pattern , $comment) ){
            throw new Exception('Le commentaire est invalide');
        }
        $this->comment = $comment;

        return $this->comment;
    }


    public function setUserLogin(string $userLogin)  :string
    {
        $pattern = self::PATTERN_USERLOGIN;
        if (! preg_match ($pattern , $userLogin) ){
            throw new Exception('Le pseudo ou login est invalide');
        }
        $this->userLogin = $userLogin;

        return $this->userLogin;
    }

    public function setDateCreation() :string
    {  
        $this->dateCreation = date('Y-m-d H:i:s');

        return $this->dateCreation;
    }

    public function getComment() :array
    {

        $comment = array(
                'itemId' => $this->itemId,
                'userLogin' => $this->userLogin,
                'comment' => $this->comment,
                'dateCreation' => $this->dateCreation

        );
        return $comment;
    }



    public function checkNewComment($newcomment, $sessionComment)
    {

        if($this->setComment($newcomment['comment']) && $this->setItemId($sessionComment['itemId'])  && $this->setUserLogin($sessionComment['login']))
        {
            
            return $this->getComment();
            
        }
        else
        {
            throw new Exception ('Format incorrect');
        }




    }











}