<?php


use App\Controller\MainController;
use PHPUnit\Framework\TestCase;

class MainControllerTest extends TestCase{

    private $mainController;

    public function index(){
      $this->mainController = new MainController();
    }

    public function testAssertInstanceOfMainController(){
      $this->index();
      $this->assertInstanceOf(MainController::class, $this->mainController);
      $this->assertTrue(method_exists ($this->mainController,  'loginPage' ));
      $this->assertTrue(method_exists ($this->mainController,  'newUserPage' ));
      $this->assertFalse(method_exists ($this->mainController,  'addNewItems' ));
      $this->assertFalse(method_exists ($this->mainController,  'listItemPages' ));

    }




  
}