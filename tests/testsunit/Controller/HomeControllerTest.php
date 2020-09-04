<?php

use App\Controller\HomeController;
use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
    private $homeController;

    public function index()
    {
        $this->homeController = new HomeController();
    }

    public function testAssertInstanceOfMainController()
    {
        $this->index();
        $this->assertInstanceOf(HomeController::class, $this->homeController);
        $this->assertTrue(method_exists($this->homeController, 'loginPage'));
        $this->assertTrue(method_exists($this->homeController, 'newUserPage'));
        $this->assertTrue(method_exists($this->homeController, 'errorPage'));
        $this->assertFalse(method_exists($this->homeController, 'addNewItems'));
        $this->assertFalse(method_exists($this->homeController, 'listItemPages'));
    }
}
