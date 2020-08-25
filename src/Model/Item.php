<?php

namespace App\Model ;

use Exception;


class Item
{   

    const PATTERN_ITEMNAME = "/^(\w[ -.,!?]*){2,50}/";
    private $itemName;
    private $category;
    private $rate;
    private $review;
    private $userName;
    private $dateCreation;

    public function __construct()
    {
        
    }
    

    public function setItemName($itemName)
    {
        $pattern = self::PATTERN_ITEMNAME;
        if (! preg_match ($pattern , $itemName) ){
            throw new Exception('Le pseudo ou login est invalide');
        }
        $this->itemName = $itemName;

        return $this->itemName;
    }






}