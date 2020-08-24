<?php

namespace App;

class TestManager{

    public function __construct()
    {
        
    }
    public function bonjour(){

        echo "test de l'autoload";
    }
   
    public static function double($number){

        return $number*2;

    }

    public static function truefunction(){

        return true;
    }
}