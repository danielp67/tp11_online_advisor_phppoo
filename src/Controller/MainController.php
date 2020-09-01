<?php

namespace App\Controller;

final class MainController
{
    public function loginPage()
    {
        return require('src/View/loginView.php');
    }

    public function newUserPage()
    {
        return require('src/View/newUserView.php');
    }

    public function errorPage($error)
    {
        $error = 'Erreur : ' . $error;
        return require('src/View/errorView.php');
    }
}
