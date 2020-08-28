<?php

use App\Model\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase{

    const PATTERN_MAIL = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    const PATTERN_USERLOGIN = "/^[a-zA-Z0-9À-ÿ_.-]{2,16}$/";
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

    public function testAssertInstanceOfUser()
    {
      $this->index();
      $this->assertInstanceOf(User::class, $this->user);
      $this->assertClassHasAttribute('userLogin', User::class);
      $this->assertClassHasAttribute('mail', User::class);
      $this->assertClassHasAttribute('pass', User::class);
      $this->assertClassHasAttribute('lastLoginAt', User::class);

    }

    /**
     * @dataProvider additionProviderMail
     */
    public function testSetMail($mail){
        $pattern = self::PATTERN_MAIL;

        $this->index();
        $this->assertMatchesRegularExpression($pattern, $this->user->setMail($mail));
        $this->assertMatchesRegularExpression($pattern, $mail);
    }

    public function additionProviderMail()
    {
        return [
            ['test@test.com'],
            ['lalalla@d.fr'],
            ['g@te.de'],
            ['gmail-dudu@tetest.fdsfd.de']
        ];
    }

    /**
     * @dataProvider additionProviderUserLogin
     */
    public function testSetUserLogin($userLogin){
      $pattern = self::PATTERN_USERLOGIN;

      $this->index();
      $this->assertMatchesRegularExpression($pattern,  $this->user->setUserLogin($userLogin));
      $this->assertMatchesRegularExpression($pattern, $userLogin);
    }


    public function additionProviderUserLogin()
    {
        return [
            ['fgrej-fdssd'],
            ['élaHfjfiod'],
            ['ÀteÀde_86'],
            ['fdsff.dfzadde'],
            ['Username']
        ];
    }

    /**
     * @dataProvider additionProviderPass
     */
    public function testSetPass($pass){
      $pattern = self::PATTERN_PASS;

      $this->index();
      $this->assertTrue(password_verify($pass, $this->user->setPass($pass)));
      $this->assertMatchesRegularExpression($pattern, $pass);
    }

    

    public function additionProviderPass()
    {
        return [
            ['fsd456'],
            ['HlHfjfiod'],
            ['ateade_86'],
            ['12lettresUni']
        ];
    }

    public function testSetLastLoginAt()
    {
      $this->index();
      $this->assertEqualsWithDelta($this->user->setLastLoginAt(), date('Y-m-d H:i:s'), 5);

    }

     /**
     * @dataProvider additionProviderFailMail
     */
    public function testFailSetMail($failMail)
    {
      $this->expectException(Exception::class);
      
      $this->index();
      $this->user->setMail($failMail);
    }

    public function additionProviderFailMail()
    {
        return [
            ['test@testcom'],
            ['lalalla@.fr'],
            ['@.de'],
            ['gmail-dudu@test.fdsfd.deux'],
            ['12lettresUni']
        ];
    }

     /**
     * @dataProvider additionProviderFailUserLogin
     */
    public function testFailSetUserLogin($failUserLogin)
    {
      $this->expectException(Exception::class);

      $this->index();
      $this->user->setUserLogin($failUserLogin);
    }


    public function additionProviderFailUserLogin()
    {
        return [
            ['test%testcom'],
            ['lalalfr7897987898585'],
            ['#.de'],
            ['gmail-fd.d*'],
            ['12lettr Uni']
        ];
    }

    /**
     * @dataProvider additionProviderFailPass
     */
    public function testFailSetPass($failPass)
    {
      $this->expectException(Exception::class);

      $this->index();
      $this->user->setPass($failPass);
    }


    public function additionProviderFailPass()
    {
        return [
            ['test%testcom'],
            ['lalalfr7897987898585'],
            ['#.de'],
            ['gmail-fd.d*'],
            ['12lettr Uni']
        ];
    }


    public function testFailSetLastLoginAt()
    { 
      $this->index();
      $this->assertNotEquals($this->user->setLastLoginAt(), '2000-11-11 11:11:11', 5);

    }


    public function testGetUserLogin()
    {
      $this->index();
      $this->assertSame($this->userLogin, $this->user->getUserLogin());
    }


    public function testFailGetUserLogin()
    {
  
      $this->index();
      $this->assertNotSame($this->failUserLogin, $this->user->getUserLogin());
    }


    
    public function testGetUser()
    {
      $this->index();
      $this->assertIsArray($this->user->getUser());
      $this->assertArrayHasKey('login', $this->user->getUser());
      $this->assertArrayHasKey('mail', $this->user->getUser());
      $this->assertArrayHasKey('pass', $this->user->getUser());
      $this->assertArrayHasKey('lastLoginAt', $this->user->getUser());
     
    }


    public function testCheckLogUser()
    { 
      $this->index();
      
      $passForm = $this->pass;
      $user = array(
        'login' => $this->userLogin,
        'mail' => $this->mail,
        'pass' => password_hash($this->pass, PASSWORD_DEFAULT),
        'lastLoginAt' => $this->user->setLastLoginAt(),
      );

      $this->assertTrue($this->user->checkLogUser($passForm, $user));
    }

    public function testFailCheckLogUser()
    {
      $this->expectException(Exception::class);

      $this->index();

      $passForm =$this->failPass;
      $user = array(
        'login' => $this->userLogin,
        'mail' => $this->mail,
        'pass' => password_hash($this->pass, PASSWORD_DEFAULT),
        'lastLoginAt' => $this->user->setLastLoginAt(),
      );

      
     $this->user->checkLogUser($passForm, $user);
      
    }

    

    public function testCheckNewUser()
    {
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
      $this->assertArrayHasKey('lastLoginAt', $this->user->checkNewUser($user));

    }


    public function testFailCheckNewUser()
    {
      $this->expectException(Exception::class);
      $user = array(
        'login' => $this->userLogin,
        'mail' => $this->failMail,
        'pass' => $this->pass,
        'pass2' => $this->pass
        );
      $this->index();
      $this->user->checkNewUser($user);

    }

  
}