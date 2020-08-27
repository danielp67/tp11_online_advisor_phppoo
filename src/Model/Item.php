<?php

namespace App\Model ;

use Exception;


class Item
{   

    const PATTERN_ITEMNAME = "/^(\w[ -.,!?]*){2,50}$/";
    const PATTERN_CATEGORY = "/^(\w[ -]*){2,30}$/";
    const PATTERN_REVIEW = "/^(\w[ -.,!?]*){2,255}$/";
    const PATTERN_USERLOGIN = "/^[a-zA-Z0-9_]{2,16}$/";
    private string $itemName;
    private string $category='';
    private int $rate=1;
    private string $review='';
    private string $userLogin='';
    private string $dateCreation;

    public function __construct(string $itemName)
    {
        $this->setItemName($itemName);
        $this->setDateCreation();
    }
    

    public function setItemName(string $itemName) :string
    {
        $pattern = self::PATTERN_ITEMNAME;
        if (! preg_match ($pattern , $itemName) ){
            throw new Exception('Le titre est invalide');
        }
        $this->itemName = $itemName;

        return $this->itemName;
    }


    public function setCategory(string $category) :string
    {
        $pattern = self::PATTERN_ITEMNAME;
        if (! preg_match ($pattern , $category) ){
            throw new Exception('La categorie est invalide');
        }
        $this->category = $category;

        return $this->category;
    }


    public function setRate(int $rate) :int
    {
        if (!is_int($rate) || $rate<=0 || $rate>5){
            throw new Exception('Note invalide');
        }
        $this->rate = $rate;

        return $this->rate;
    }


    public function setReview(string $review) :string
    {
        $pattern = self::PATTERN_REVIEW;
        if (! preg_match ($pattern , $review) ){
            throw new Exception('Le commentaire est invalide');
        }
        $this->review = $review;

        return $this->review;
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


    public function getItem() :array
    {

        $item = array(
                'itemName' => $this->itemName,
                'category' => $this->category,
                'rate' => $this->rate,
                'review' => $this->review,
                'userLogin' => $this->userLogin,
                'dateCreation' => $this->dateCreation

        );
        return $item;
    }

    public function checkNewItem(array $item, string $userLogin) :array
    {  
        if( $this->setCategory($item['category']) && $this->setRate($item['rate']) && $this->setReview($item['review']) && $this->setUserLogin($userLogin))
        {
            return $this->getItem();
            
        }
        else
        {
            throw new Exception ('Format incorrect');
        }

    }
    

}