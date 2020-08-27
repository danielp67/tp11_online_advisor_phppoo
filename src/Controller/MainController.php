<?php


namespace App\Controller ;


use App\View;


class MainController {


    
    public function loginPage()
    {
        return require('src/View/loginView.php');
    }

    public function newUserPage()
    {
        return require('src/View/newUserView.php');
    }



}


