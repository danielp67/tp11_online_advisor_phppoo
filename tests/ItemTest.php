<?php

use App\Model\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase{

    const PATTERN_MAIL = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    const PATTERN_ITEMNAME = "/^[a-zA-Z0-9_]{2,16}$/";
    const PATTERN_PASS = "/^[a-zA-Z0-9_]{6,12}$/";
    private $item;

    public function index(){
      $this->item = new Item();
    }

    public function testAssertInstanceOfUser(){
      $this->index();
      $this->assertInstanceOf(Item::class, $this->item);
      $this->assertClassHasAttribute('itemName', Item::class);
      $this->assertClassHasAttribute('category', Item::class);
      $this->assertClassHasAttribute('rate', Item::class);
      $this->assertClassHasAttribute('review', Item::class);
      $this->assertClassHasAttribute('userName', Item::class);
      $this->assertClassHasAttribute('dateCreation', Item::class);

    }


    public function testsetItemName(){

      $pattern = self::PATTERN_ITEMNAME;

      $this->index();
      $this->assertMatchesRegularExpression($pattern, $this->item->setItemName($this->itemName));
    }

    
  
}