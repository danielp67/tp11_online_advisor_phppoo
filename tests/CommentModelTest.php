<?php

use App\Model\CommentModel;
use PHPUnit\Framework\TestCase;

class CommentModelTest extends TestCase{

    private $commentModel;

    public function index(){
      $this->commentModel = new CommentModel();
    }

    public function testAssertInstanceOfCommentModel(){
      $this->index();
      $this->assertInstanceOf(CommentModel::class, $this->commentModel);
      $this->assertClassHasAttribute('db', CommentModel::class);
      $this->assertTrue(method_exists ($this->commentModel,  'getComments' ));
      $this->assertTrue(method_exists ($this->commentModel,  'createNewComment' ));
      $this->assertFalse(method_exists ($this->commentModel,  'postComments' ));
      $this->assertFalse(method_exists ($this->commentModel,  'deleteUser' ));


    }


  
}