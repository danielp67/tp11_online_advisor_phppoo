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


  
}