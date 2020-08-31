<?php

use App\Model\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase{

    const PATTERN_ITEMNAME = "/^[a-zA-Z0-9À-ÿ .'&()-]{2,50}$/";
    const PATTERN_CATEGORY = "/^[a-zA-Z0-9À-ÿ .-]{2,30}$/";
    const PATTERN_REVIEW = "/^[a-zA-Z0-9À-ÿ .,?!'&()-]{2,255}$/";
    const PATTERN_USERLOGIN = "/^[a-zA-Z0-9À-ÿ_.-]{2,16}$/";
    private object $item;
    private string $itemName ='Tintin et Milou';
    private string $category ='Livre';
    private int $rate=3;
    private string $review ="Voila un tres bon livre et oui mon commentaire et long mais c'est pour le test";
    private string $userLogin ='Username';
    private int $userId =3;
    private string $failItemName ='1';
    private string $failCategory = '';
    private int $failRate=8;
    private string $failReview ="Voila un tres bon livre et oui mon commentaire et long mais c'est pour le test &é_çà&é_çéà";
    private string $failUserLogin ='Username-failllllllllllllll';



    public function index(){
      $this->item = new Item($this->itemName);
    }

    public function testAssertInstanceOfItem()
    {
      $this->index();
      $this->assertInstanceOf(Item::class, $this->item);
      $this->assertClassHasAttribute('itemName', Item::class);
      $this->assertClassHasAttribute('category', Item::class);
      $this->assertClassHasAttribute('rate', Item::class);
      $this->assertClassHasAttribute('review', Item::class);
      $this->assertClassHasAttribute('userId', Item::class);
      $this->assertClassHasAttribute('userLogin', Item::class);
      $this->assertClassHasAttribute('dateCreation', Item::class);

    }


    

     /**
     * @dataProvider additionProviderItemName
     */
    public function testSetItemName($itemName)
    {

      $pattern = self::PATTERN_ITEMNAME;

      $this->index();
      $this->assertMatchesRegularExpression($pattern, $this->item->setItemName($itemName));

    }
    
    public function additionProviderItemName()
    {
        return [
            ['Tintin et Milou'],
            ['élaH fjfiod'],
            ['ÀteÀde 86'],
            ['fdsff. dfzadde'],
            ['User&name']
        ];
    }


    /**
     * @dataProvider additionProviderCategory
     */
    public function testSetCategory($category)
    {

      $pattern = self::PATTERN_CATEGORY;

      $this->index();
      $this->assertMatchesRegularExpression($pattern, $this->item->setCategory($category));

    }

    public function additionProviderCategory()
    {
        return [
            ['Tintin et Milou'],
            ['élaH fjfiod'],
            ['ÀteÀde 86'],
            ['fdsff. dfzadde'],
            ['Username']
        ];
    }

      /**
     * @dataProvider additionProviderRate
     */
    public function testSetRate($rate)
    {

      $this->index();
      $this->assertIsInt($this->item->setRate($rate));

    }

    public function additionProviderRate()
    {
        return [
            [1],
            [2],
            [3],
            [4],
            [5]
        ];
    }

    /**
     * @dataProvider additionProviderReview
     */
    public function testSetReview($review)
    {

      $pattern = self::PATTERN_REVIEW;

      $this->index();
      $this->assertMatchesRegularExpression($pattern, $this->item->setReview($review));

    }

 
    public function additionProviderReview()
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
     * @dataProvider additionProviderUserId
     */
    public function testSetUserId($userId){

      $this->index();
      $this->assertIsInt($this->item->setUserId($userId));
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
     * @dataProvider additionProviderUserLogin
     */
    public function testSetUserLogin($userLogin)
    {
      $pattern = self::PATTERN_USERLOGIN;

      $this->index();
      $this->assertMatchesRegularExpression($pattern,  $this->item->setUserLogin($userLogin));
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
      $this->assertEqualsWithDelta($this->item->setDateCreation(), date('Y-m-d H:i:s'), 5);

    }


        //test fail setters

    /**
     * @dataProvider additionProviderFailItemName
     */
    public function testFailSetItemName($failItemName)
    {
      $this->expectException(Exception::class);
    

      $this->index();
     $this->item->setItemName($failItemName);

    }

    public function additionProviderFailItemName()
    {
        return [
            ['m'],
            ['lalalfr 78979878    tu       ytry   e  thtr           98585'],
            ['#.de'],
            ['gmail-fd.d*'],
            ['12lettr[ Uni']
        ];
    }


     /**
     * @dataProvider additionProviderFailCategory
     */
    public function testFailSetCategory($failCategory)
    {
      $this->expectException(Exception::class);
    

      $this->index();
      $this->item->setCategory($failCategory);

    }

    public function additionProviderFailCategory()
    {
        return [
            ['m'],
            ['lalalfr 78979878    tu       ytry    (blabla)      98585'],
            ['#.de'],
            ['gmail-fd.d*'],
            ['12lettr& Uni']
        ];
    }

      /**
     * @dataProvider additionProviderFailRate
     */
    public function testFailSetRate($failRate)
    {
      $this->expectException(Exception::class);
      $this->index();
      $this->item->setRate($failRate);
    }

    public function additionProviderFailRate()
    {
        return [
            [6],
            [-1],
            [0],
            [75],
        ];
    }





     /**
     * @dataProvider additionProviderFailReview
     */
    public function testFailSetReview($failReview)
    {
      $this->expectException(Exception::class);

      $this->index();
      $this->item->setReview($failReview);

    }
    

    public function additionProviderFailReview()
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
     * @dataProvider additionProviderFailUserId
     */
    public function testFailSetUserId($userId){
      $this->expectException(Exception::class);

      $this->index();
      $this->item->setUserId($userId);
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
     * @dataProvider additionProviderFailUserLogin
     */
    public function testFailSetUserLogin($failUserLogin)
    {
      $this->expectException(Exception::class);

      $this->index();
      $this->item->setUserLogin($failUserLogin);
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
      $this->assertNotEquals($this->item->setDateCreation(), '2000-11-11 11:11:11', 5);

    }

    
    
    public function testGetUser()
    {
      $this->index();
      $this->assertIsArray($this->item->getItem());
      $this->assertArrayHasKey('itemName', $this->item->getItem());
      $this->assertArrayHasKey('category', $this->item->getItem());
      $this->assertArrayHasKey('rate', $this->item->getItem());
      $this->assertArrayHasKey('review', $this->item->getItem());
      $this->assertArrayHasKey('userId', $this->item->getItem());
      $this->assertArrayHasKey('userLogin', $this->item->getItem());
      $this->assertArrayHasKey('dateCreation', $this->item->getItem());
     
    }

    public function testCheckNewItem()
    {
      
      $this->index();

      $item = array(
        'itemName' => $this->itemName,
        'category' => $this->category,
        'rate' => $this->rate,
        'review' => $this->review,
      );

      $userLogin = array(
        'userId' => $this->userId,
        'login' => $this->userLogin,

      );

      $this->assertIsArray($this->item->checkNewItem($item, $userLogin));
      $this->assertArrayHasKey('itemName', $this->item->checkNewItem($item, $userLogin));
      $this->assertArrayHasKey('category', $this->item->checkNewItem($item, $userLogin));
      $this->assertArrayHasKey('rate', $this->item->checkNewItem($item, $userLogin));
      $this->assertArrayHasKey('review', $this->item->checkNewItem($item, $userLogin));
      $this->assertArrayHasKey('userId', $this->item->checkNewItem($item, $userLogin));
      $this->assertArrayHasKey('userLogin', $this->item->checkNewItem($item, $userLogin));
      $this->assertArrayHasKey('dateCreation', $this->item->checkNewItem($item, $userLogin));

    }

    
  
}