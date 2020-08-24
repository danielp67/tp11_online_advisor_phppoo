<?php

use App\Controller\Controller;
use App\TestManager;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase{
   
 
    public function testclassController(){

     //  $this->assertTrue(TestManager::truefunction());
       // $this->assertEmpty(['foo']);
        $user = new Controller();
        $this->assertInstanceOf(Controller::class, $user);
        $this->assertClassHasAttribute('fot', Controller::class);
        $this->assertClassHasStaticAttribute('foot', Controller::class);

    } 
  
}