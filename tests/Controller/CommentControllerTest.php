<?php

use App\Controller\CommentController;
use PHPUnit\Framework\TestCase;

class CommentControllerTest extends TestCase{

    private $commentController;

    public function index(){
      $this->commentController = new CommentController();
    }

    public function testAssertInstanceOfCommentController(){
      $this->index();
      $this->assertInstanceOf(CommentController::class, $this->commentController);
      $this->assertClassHasAttribute('comment', CommentController::class);
      $this->assertClassHasAttribute('commentModel', CommentController::class);
      $this->assertTrue(method_exists ($this->commentController,  'addComment' ));
      $this->assertFalse(method_exists ($this->commentController,  'addNewItems' ));
      $this->assertFalse(method_exists ($this->commentController,  'listItemPages' ));

    }

    public function testAddComment()
    {   $this->index();
      /*
        $response = require('src/View/loginView.php');
      
      

      $mock = $this->getMockBuilder(CommentController::class)
                   ->disableOriginalConstructor()
                   ->setMethods(['addComment'])
                   ->getMock();

        $mock
            ->method('addComment')
            ->will($response);

            $this->assertContains('Location: http://localhost/TP11_online_advisor_phppoo/items/getComments/1', xdebug_get_headers());
       
    
        $this->assertSame('commentModel', CommentController::class);

       */
    }


  
}