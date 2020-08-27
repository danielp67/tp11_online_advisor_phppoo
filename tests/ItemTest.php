<?php

use App\Model\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase{

    const PATTERN_ITEMNAME = "/^(\w[ -.,!?]*){2,50}$/";
    const PATTERN_CATEGORY = "/^(\w[ -]*){2,20}$/";
    const PATTERN_REVIEW = "/^(\w[ -.,!?]*){2,255}$/";
    const PATTERN_USERLOGIN = "/^[a-zA-Z0-9_]{2,16}$/";
    private object $item;
    private string $itemName ='Tintin et Milou';
    private string $category ='Livre';
    private int $rate=3;
    private string $review ="Voila un tres bon livre et oui mon commentaire et long mais c'est pour le test";
    private string $userLogin ='Username';
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
      $this->assertClassHasAttribute('userLogin', Item::class);
      $this->assertClassHasAttribute('dateCreation', Item::class);

    }


    public function testSetItemName()
    {

      $pattern = self::PATTERN_ITEMNAME;

      $this->index();
      $this->assertMatchesRegularExpression($pattern, $this->item->setItemName($this->itemName));

    }

    public function testSetCategory()
    {

      $pattern = self::PATTERN_CATEGORY;

      $this->index();
      $this->assertMatchesRegularExpression($pattern, $this->item->setCategory($this->category));

    }

    public function testSetRate()
    {

      $this->index();
      $this->assertIsInt($this->item->setRate($this->rate));

    }


    public function testSetReview()
    {

      $pattern = self::PATTERN_REVIEW;

      $this->index();
      $this->assertMatchesRegularExpression($pattern, $this->item->setReview($this->review));

    }


    public function testSetUserLogin()
    {
      $pattern = self::PATTERN_USERLOGIN;

      $this->index();
      $this->assertMatchesRegularExpression($pattern,  $this->item->setUserLogin($this->userLogin));
    }


    
    public function testSetDateCreation()
    {
      $this->index();
      $this->assertEqualsWithDelta($this->item->setDateCreation(), date('Y-m-d H:i:s'), 5);

    }


        //test fail setters
    public function testFailSetItemName()
    {
      $this->expectException(Exception::class);
    

      $this->index();
     $this->item->setItemName($this->failItemName);

    }

    public function testFailSetCategory()
    {
      $this->expectException(Exception::class);
    

      $this->index();
      $this->item->setCategory($this->failCategory);

    }

    public function testFailSetRate()
    {
      $this->expectException(Exception::class);
      $this->index();
      $this->item->setRate($this->failRate);
    }


    public function testFailSetReview()
    {
      $this->expectException(Exception::class);

      $this->index();
      $this->item->setReview($this->failReview);

    }


    public function testFailSetUserLogin()
    {
      $this->expectException(Exception::class);

      $this->index();
      $this->item->setUserLogin($this->failUserLogin);
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
        'userLogin' => $this->userLogin,
      );

      $userLogin = $this->userLogin;

      $this->assertIsArray($this->item->checkNewItem($item, $userLogin));
      $this->assertArrayHasKey('itemName', $this->item->checkNewItem($item, $userLogin));
      $this->assertArrayHasKey('category', $this->item->checkNewItem($item, $userLogin));
      $this->assertArrayHasKey('rate', $this->item->checkNewItem($item, $userLogin));
      $this->assertArrayHasKey('review', $this->item->checkNewItem($item, $userLogin));
      $this->assertArrayHasKey('userLogin', $this->item->checkNewItem($item, $userLogin));
      $this->assertArrayHasKey('dateCreation', $this->item->checkNewItem($item, $userLogin));

    }

    
  
}