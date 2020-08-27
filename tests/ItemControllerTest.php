<?php

use App\Controller\ItemController;
use PHPUnit\Framework\TestCase;

class ItemControllerTest extends TestCase{

    private $itemController;

    public function index(){
      $this->itemController = new ItemController();
    }

    public function testAssertInstanceOfItemController(){
      $this->index();
      $this->assertInstanceOf(ItemController::class, $this->itemController);
      $this->assertClassHasAttribute('item', ItemController::class);
      $this->assertClassHasAttribute('itemModel', ItemController::class);
      $this->assertTrue(method_exists ($this->itemController,  'listItemPage' ));
      $this->assertTrue(method_exists ($this->itemController,  'getComments' ));
      $this->assertTrue(method_exists ($this->itemController,  'addNewItem' ));
      $this->assertFalse(method_exists ($this->itemController,  'addNewItems' ));
      $this->assertFalse(method_exists ($this->itemController,  'listItemPages' ));


    }


  
}