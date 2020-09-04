<?php

use App\Router\Router;
use PHPUnit\Framework\TestCase;
use Symfony\Component\BrowserKit\Request;

class RouterTest extends TestCase
{
    private $router;
    private $url;

    public function __setUp()
    {
        $this->router = new Router($this->url);
    }

    public function testGetMethod()
    {   
        
    }


}
