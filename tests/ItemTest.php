<?php

use App\Model\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase{

    
    const PATTERN_ITEMNAME = "/^(\w[ -.,!?]*){2,50}/";
    private $item;
    private $itemName ='Tintin et Milou';
    private $category ='Livre';
    private $rate=3;
    private $failitemName ='1';
    private $failCategory = 42;
    private $failRate=8;

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


    public function testSetItemName(){

      $pattern = self::PATTERN_ITEMNAME;

      $this->index();
      $this->assertMatchesRegularExpression($pattern, $this->item->setItemName($this->itemName));

    }


    
  
}