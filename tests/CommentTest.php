<?php

use App\Model\Comment;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase{

    const PATTERN_COMMENT = "/^(\w[ -.,!?]*){2,255}$/";
    const PATTERN_USERLOGIN = "/^[a-zA-Z0-9_]{2,16}$/";
    private object $objComment;
    private int $itemId =3;
    private string $comment ="Voila un tres bon livre et oui mon commentaire et long mais c'est pour le test";
    private string $userLogin ='Username';
    private int $failItemId =0;
    private string $failComment ="Voila un tres bon livre et oui mon commentaire et long mais c'est pour le test &é_çà&é_çéà";
    private string $failUserLogin ='Username-failllllllllllllll';



    public function index(){
      $this->objComment = new Comment($this->comment);
    }

    public function testAssertInstanceOfComment()
    {
      $this->index();
      $this->assertInstanceOf(Comment::class, $this->objComment);
      $this->assertClassHasAttribute('itemId', Comment::class);
      $this->assertClassHasAttribute('userLogin', Comment::class);
      $this->assertClassHasAttribute('comment', Comment::class);
      $this->assertClassHasAttribute('dateCreation', Comment::class);

    }


    public function testSetItemId()
    {
      $this->index();
      $this->assertIsInt($this->objComment->setItemId($this->itemId));
    }


    
    public function testSetComment()
    {

      $pattern = self::PATTERN_COMMENT;

      $this->index();
      $this->assertMatchesRegularExpression($pattern, $this->objComment->setComment($this->comment));

    }


    public function testSetUserLogin()
    {
      $pattern = self::PATTERN_USERLOGIN;

      $this->index();
      $this->assertMatchesRegularExpression($pattern,  $this->objComment->setUserLogin($this->userLogin));
    }


    
    public function testSetDateCreation()
    {
      $this->index();
      $this->assertEqualsWithDelta($this->objComment->setDateCreation(), date('Y-m-d H:i:s'), 5);

    }





    //test fail setters
    public function testFailSetItemId()
    {
      $this->expectException(Exception::class);
    

      $this->index();
      $this->objComment->setItemId($this->failItemId);

    }



    public function testFailSetComment()
    {
      $this->expectException(Exception::class);

      $this->index();
      $this->objComment->setComment($this->failComment);

    }


    public function testFailSetUserLogin()
    {
      $this->expectException(Exception::class);

      $this->index();
      $this->objComment->setUserLogin($this->failUserLogin);
    }


    
    public function testFailSetDateCreation()
    { 
      $this->index();
      $this->assertNotEquals($this->objComment->setDateCreation(), '2000-11-11 11:11:11', 5);

    }







    
  
}