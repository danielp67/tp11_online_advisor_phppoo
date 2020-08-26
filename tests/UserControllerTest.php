<?php

use App\Controller\UserController;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase{

    private $userController;

    public function index(){
      $this->userController = new UserController();
    }

    public function testAssertInstanceOfUserController(){
      $this->index();
      $this->assertInstanceOf(UserController::class, $this->userController);
      $this->assertClassHasAttribute('userModel', UserController::class);
      $this->assertClassHasAttribute('user', UserController::class);
      $this->assertTrue(method_exists ($this->userController,  'logUser' ));
      $this->assertTrue(method_exists ($this->userController,  'addNewUser' ));
    }


  
}