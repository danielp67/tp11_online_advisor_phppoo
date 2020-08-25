<?php

use App\Model\User;
use PharIo\Manifest\InvalidEmailException;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase{

    const PATTERN_MAIL = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    const PATTERN_USERLOGIN = "/^[a-zA-Z0-9_]{2,16}$/";
    const PATTERN_PASS = "/^[a-zA-Z0-9_]{6,12}$/";
    private $userLogin ='Username';
    private $mail ='test@test.com';
    private $pass='passmail';
    private $failUserLogin ='1';
    private $failMail ='testtestcom';
    private $failPass='passmailtooooolong';
    private $user;

    public function index(){
      $this->user = new User($this->userLogin);
    }

    public function testAssertInstanceOfUser(){
      $this->index();
      $this->assertInstanceOf(User::class, $this->user);
      $this->assertClassHasAttribute('userLogin', User::class);
      $this->assertClassHasAttribute('mail', User::class);
      $this->assertClassHasAttribute('pass', User::class);
      $this->assertClassHasAttribute('last_login_at', User::class);

    }

    
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

    
    public function testFailSetMail(){
      $this->expectException(Exception::class);
      
      $this->index();
      $this->user->setMail($this->failMail);
    }

    public function testFailSetUserLogin(){
      $this->expectException(Exception::class);

      $this->index();
      $this->user->setUserLogin($this->failUserLogin);
    }


    public function testFailSetPass(){
      $this->expectException(Exception::class);

      $this->index();
      $this->user->setPass($this->failPass);
    }


    public function testGetUserLogin(){
      $this->index();
      $this->assertSame($this->userLogin, $this->user->getUserLogin());
    }


    public function testFailGetUserLogin(){
  
      $this->index();
      $this->assertNotSame($this->failUserLogin, $this->user->getUserLogin());
    }


    public function testCheckLogUser(){
      $passForm =$this->pass;

      $this->index();
      $this->assertTrue($this->user->checkLogUser($this->pass,$passForm));

    }

    public function testFailCheckLogUser(){
      $this->expectException(Exception::class);
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
      $this->expectException(Exception::class);
      $user = array(
        'login' => $this->userLogin,
        'mail' => $this->failMail,
        'pass' => $this->pass,
        'pass2' => $this->pass
        );
      $this->index();
      $this->assertIsArray($this->user->checkNewUser($user));

    }

  
}