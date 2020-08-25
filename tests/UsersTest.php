<?php

use App\Controller\Users;
use App\Model\User;
use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase{

    private $users;

    public function index(){
      $this->users = new Users();
    }

    public function testAssertInstanceOfUsers(){
      $this->index();
      $this->assertInstanceOf(Users::class, $this->users);
    }

    /*
    public function testSetMail(){
        $pattern = self::PATTERN_MAIL;

        $this->index();
        $this->assertMatchesRegularExpression($pattern, $this->user->setMail($this->mail));
        $this->assertMatchesRegularExpression($pattern, $this->mail);
    }

    public function testSetUserLogin(){
      $pattern = self::PATTERN_USERLOGIN;

      $this->index();
      $this->assertMatchesRegularExpression($pattern,  $this->user->setUserLogin($this->userLogin));
      $this->assertMatchesRegularExpression($pattern, $this->userLogin);
    }


    public function testSetPass(){
      $pattern = self::PATTERN_PASS;

      $this->index();
      $this->assertMatchesRegularExpression($pattern,  $this->user->setPass($this->pass));
      $this->assertMatchesRegularExpression($pattern, $this->pass);
    }

    /*
    public function testFailSetMail(){
      $pattern = self::PATTERN_MAIL;

      $this->index();
      $this->assertMatchesRegularExpression($pattern, $this->user->setMail($this->failMail));
      $this->assertMatchesRegularExpression($pattern, $this->failMail);
    }

    public function testFailSetUserLogin(){
      $pattern = self::PATTERN_USERLOGIN;

      $this->index();
      $this->assertMatchesRegularExpression($pattern,  $this->user->setUserLogin($this->failUserLogin));
      $this->assertMatchesRegularExpression($pattern, $this->failUserLogin);
    }


    public function testFailSetPass(){
      $pattern = self::PATTERN_PASS;

      $this->index();
      $this->assertMatchesRegularExpression($pattern,  $this->user->setPass($this->failPass));
      $this->assertMatchesRegularExpression($pattern, $this->failPass);
    }

    


    public function testGetUserLogin(){
      $this->index();
      $this->assertSame($this->userLogin, $this->user->getUserLogin());
    }


    public function testFailGetUserLogin(){
      $this->index();
      $this->assertSame($this->failUserLogin, $this->user->getUserLogin());
    }


    public function testCheckLogUser(){
      $passForm =$this->pass;

      $this->index();
      $this->assertTrue($this->user->checkLogUser($this->pass,$passForm));

    }

    public function testFailCheckLogUser(){
      $passForm =$this->failPass;

      $this->index();
      $this->assertFalse($this->user->checkLogUser($this->pass,$passForm));
      
    }
  

    public function testCheckNewUser(){
      $user = array(
        'login' => $this->userLogin,
        'mail' => $this->mail,
        'pass' => $this->pass,
        'pass2' => $this->pass
        );

      $this->index();
      $this->assertIsArray($this->user->checkNewUser($user));
      $this->assertArrayHasKey('login', $this->user->checkNewUser($user));
      $this->assertArrayHasKey('mail', $this->user->checkNewUser($user));
      $this->assertArrayHasKey('pass', $this->user->checkNewUser($user));
      $this->assertArrayHasKey('pass2', $this->user->checkNewUser($user));

    }


    public function testFailCheckNewUser(){
      $user = array(
        'login' => $this->userLogin,
        'mail' => $this->failMail,
        'pass' => $this->pass,
        'pass2' => $this->pass
        );
      $this->index();
      $this->assertIsArray($this->user->checkNewUser($user));

    }
*/
  
}