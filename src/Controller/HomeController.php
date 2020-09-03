<?php

namespace App\Controller;

final class HomeController
{
    public function loginPage(): void
    {
        require('src/View/loginView.php');
    }

    public function newUserPage(): void
    {
        require('src/View/newUserView.php');
    }

    public function errorPage($error): void
    {
        $error = 'Erreur : ' . $error;
        require('src/View/errorView.php');
    }
}
