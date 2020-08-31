<?php

use App\Model\ItemModel;
use PHPUnit\Framework\TestCase;

class ItemModelTest extends TestCase{

    private $itemModel;

    public function index(){
      $this->itemModel = new ItemModel();
    }

    public function testAssertInstanceOfItemModel(){
      $this->index();
      $this->assertInstanceOf(ItemModel::class, $this->itemModel);
      $this->assertClassHasAttribute('db', ItemModel::class);
      $this->assertTrue(method_exists ($this->itemModel,  'createNewItem' ));
      $this->assertTrue(method_exists ($this->itemModel,  'getItemsDb' ));
      $this->assertTrue(method_exists ($this->itemModel,  'getItemDb' ));
      $this->assertFalse(method_exists ($this->itemModel,  'updateUserDateLog' ));
      $this->assertFalse(method_exists ($this->itemModel,  'deleteUser' ));


    }


  
}