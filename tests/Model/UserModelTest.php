<?php

use App\Model\UserModel;
use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase{

    private $userModel;

    public function index(){
      $this->userModel = new UserModel();
    }

    public function testAssertInstanceOfUserModel(){
      $this->index();
      $this->assertInstanceOf(UserModel::class, $this->userModel);
      $this->assertClassHasAttribute('db', UserModel::class);
      $this->assertTrue(method_exists ($this->userModel,  'checkUserExist' ));
      $this->assertTrue(method_exists ($this->userModel,  'createNewUser' ));
      $this->assertTrue(method_exists ($this->userModel,  'getUserDb' ));
      $this->assertTrue(method_exists ($this->userModel,  'updateUserDateLog' ));
      $this->assertTrue(method_exists ($this->userModel,  'deleteUser' ));


    }


  
}