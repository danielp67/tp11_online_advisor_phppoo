<?php

use App\Model\Comment;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase{

    const PATTERN_COMMENT = "/^[a-zA-Z0-9À-ÿ .,?!'&()-]{2,255}$/";
    const PATTERN_USERLOGIN = "/^[a-zA-Z0-9À-ÿ_.-]{2,16}$/";
    private object $objComment;
    private int $itemId =3;
    private int $userId =3;
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
      $this->assertClassHasAttribute('userId', Comment::class);
      $this->assertClassHasAttribute('userLogin', Comment::class);
      $this->assertClassHasAttribute('comment', Comment::class);
      $this->assertClassHasAttribute('dateCreation', Comment::class);

    }

     /**
     * @dataProvider additionProviderItemId
     */
    public function testSetItemId($itemId)
    {
      $this->index();
      $this->assertIsInt($this->objComment->setItemId($itemId));
    }

    public function additionProviderItemId()
    {
        return [
            [1],
            [23],
            [258],
            [45.5]
        ];
    }




      /**
     * @dataProvider additionProviderUserId
     */
    public function testSetUserId($userId){

      $this->index();
      $this->assertIsInt($this->objComment->setUserId($userId));
  }

  public function additionProviderUserId()
  {
      return [
          [1],
          [23],
          [258],
          [45.5]
      ];
  }


     /**
     * @dataProvider additionProviderComment
     */
    public function testSetComment($comment)
    {
      $pattern = self::PATTERN_COMMENT;

      $this->index();
      $this->assertMatchesRegularExpression($pattern, $this->objComment->setComment($comment));

    }

    public function additionProviderComment()
    {
        return [
            ['lalalfr 78979878    tu       ytry    (blabla)      98585'],
            ['élaH fjfiod c\'est vrai'],
            ['ÀteÀde 86 '],
            ['fdsff. dfzadde ? bla-bla'],
            ['Username& !!!!!']
        ];
    }


        /**
     * @dataProvider additionProviderUserLogin
     */
    public function testSetUserLogin($userLogin)
    {
      $pattern = self::PATTERN_USERLOGIN;

      $this->index();
      $this->assertMatchesRegularExpression($pattern,  $this->objComment->setUserLogin($userLogin));
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

     


    
    public function testSetDateCreation()
    {
      $this->index();
      $this->assertEqualsWithDelta($this->objComment->setDateCreation(), date('Y-m-d H:i:s'), 5);

    }





    //test fail setters
    
      /**
     * @dataProvider additionProviderFailItemId
     */
    public function testFailSetItemId($failItemId)
    {
      $this->expectException(Exception::class);
    

      $this->index();
      $this->objComment->setItemId($failItemId);

    }

  public function additionProviderFailItemId()
  {
      return [
          [-1],
          [-258],
          [-9258],
          [-45.99]
      ];
  }


      /**
     * @dataProvider additionProviderFailUserId
     */
    public function testFailSetUserId($userId){
      $this->expectException(Exception::class);

      $this->index();
      $this->objComment->setUserId($userId);
  }

  public function additionProviderFailUserId()
  {
      return [
          [-1],
          [-258],
          [-9258],
          [-45.99]
      ];
  }


    /**
     * @dataProvider additionProviderFailComment
     */
    public function testFailSetComment($failComment)
    {
      $this->expectException(Exception::class);

      $this->index();
      $this->objComment->setComment($failComment);
    }

    public function additionProviderFailComment()
    {
        return [
            ['m'],
            ['lalalfr 78979878    tu       ytry    (blabla)      98585  lalalfr 78979878    tu       ytry    (blabla)      98585   lalalfr 78979878    tu       ytry    (blabla)      98585  lalalfr 78979878    tu       ytry    (blabla)      98585  lalalfr 78979878    tu       ytry    (blabla)      98585'],
            ['#.de'],
            ['gmail-fd.d*'],
            ['12lettr[ Uni']
        ];
    }


   /**
     * @dataProvider additionProviderFailUserLogin
     */
    public function testFailSetUserLogin($failUserLogin)
    {
      $this->expectException(Exception::class);

      $this->index();
      $this->objComment->setUserLogin($failUserLogin);
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

    
    public function testFailSetDateCreation()
    { 
      $this->index();
      $this->assertNotEquals($this->objComment->setDateCreation(), '2000-11-11 11:11:11', 5);

    }


    
    public function testGetComment()
    {

        $this->index();
        $this->assertIsArray($this->objComment->getComment());
        $this->assertArrayHasKey('itemId', $this->objComment->getComment());
        $this->assertArrayHasKey('userId', $this->objComment->getComment());
        $this->assertArrayHasKey('userLogin', $this->objComment->getComment());
        $this->assertArrayHasKey('comment', $this->objComment->getComment());
        $this->assertArrayHasKey('dateCreation', $this->objComment->getComment());

    }



    public function testCheckNewComment()
    {

      $this->index();

      $sessionComment = array(
        'userId' => $this->userId,
        'itemId' => $this->itemId,
        'login' => $this->userLogin,
      );

      $newcomment = array(
        'comment' => $this->comment
      );

      $this->assertIsArray($this->objComment->checkNewComment($newcomment, $sessionComment));
      $this->assertArrayHasKey('userId', $this->objComment->checkNewComment($newcomment, $sessionComment));
      $this->assertArrayHasKey('itemId', $this->objComment->checkNewComment($newcomment, $sessionComment));
      $this->assertArrayHasKey('userLogin', $this->objComment->checkNewComment($newcomment, $sessionComment));
      $this->assertArrayHasKey('comment', $this->objComment->checkNewComment($newcomment, $sessionComment));
      $this->assertArrayHasKey('dateCreation', $this->objComment->checkNewComment($newcomment, $sessionComment));

        }

  
  
}