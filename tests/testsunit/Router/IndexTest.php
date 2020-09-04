<?php

use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{



    /**
     * @runInSeparateProcess
     * @return void
     */
    public function testGetMethod()
    {   
        $_GET['name'] = 'Daniel';

        ob_start();
        include 'index.php';
        $content = ob_get_clean();

        $this->assertEquals('Hello Daniel', $content);

    }


}
