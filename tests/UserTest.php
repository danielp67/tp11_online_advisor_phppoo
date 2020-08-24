<?php

use App\Controller\Controller;
use App\Model\User;
use App\TestManager;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase{
  
    /**
     * @expectedException \App\Exception
     */
    public function testMailCheck(){
        $pattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
        $userLogin ='Username';
        $mail ='test@test.com';
        $pass='passmail';
        
        $user = new User($userLogin, $mail, $pass);
        $this->assertInstanceOf(User::class, $user);
        $this->assertMatchesRegularExpression($pattern, $user->mailcheck($mail));
        $this->assertMatchesRegularExpression($pattern, $mail);
    }

    public function testUserLoginCheck(){
      $pattern = "/^[a-zA-Z0-9_]{3,16}$/";
      $userLogin ='Username';
      $mail ='test@test.com';
      $pass='passmail';
      
      $user = new User($userLogin, $mail, $pass);
      $this->assertInstanceOf(User::class, $user);
      $this->assertMatchesRegularExpression($pattern, $user->userLoginCheck($userLogin));
      $this->assertMatchesRegularExpression($pattern, $userLogin);
    }


    public function testPassCheck(){
      $pattern = "/^[a-zA-Z0-9_]{6,12}$/";
      $userLogin ='Username';
      $mail ='test@test.com';
      $pass='passmail';
      
      $user = new User($userLogin, $mail, $pass);
      $this->assertInstanceOf(User::class, $user);
      $this->assertMatchesRegularExpression($pattern, $user->passCheck($pass));
      $this->assertMatchesRegularExpression($pattern, $pass);
    }
  


  /*
    public function testdbConnect(){

        $db = new User();
        $req = $db->dbConnect();
        $this->assertInstanceOf(PDO::class, $req);
       
    }
 
    public function testCheckUserExist(){

        $user = new User();
        $this->assertInstanceOf(User::class, $user);

        $userLogin ='Username';
        $mail ="monemail";
        $reqUser = $user->checkUserExist($userLogin, $mail);
        $this->assertTrue($reqUser);

        $userLogin ='Usernamedefault';
        $mail ="monemaildefault";
        $reqUser = $user->checkUserExist($userLogin, $mail);
        $this->assertFalse($reqUser);
        
    }


    public function testCreateNewUser(){

         $user = new User();
         $this->assertInstanceOf(User::class, $user);
         
         $userLogin ='Username';
         $mail ="monemail";
         $pass='passmail';
         $reqUser = $user->createNewUser($userLogin, $mail, $pass);
         $this->assertTrue($reqUser);  
 
     } 

     */
  
}