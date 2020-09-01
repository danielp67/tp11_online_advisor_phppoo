<?php

namespace App\Controller;

use App\Model\User;
use App\Model\UserModel;

final class UserController
{
    private $user;
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }


    public function logUser() :void
    {
        $this->user = new User($_POST['login']);
        $userLogin = $this->user->getUserLogin();

        var_dump($_POST);
        $getUserDb = $this->userModel->getUserDb($userLogin);

        $checkUser = $this->user->checkLogUser($_POST['pass'], $getUserDb);
        $getUserDb = $this->user->getUser();

        if ($checkUser) {
            $this->userModel->updateUserDateLog($getUserDb);
            $this->sessionStart($getUserDb);
        }
    }


    public function addNewUser() :void
    {
        $this->user = new User($_POST['login']);
        $newUser = $this->user->checkNewUser($_POST);

        $checkUser = $this->userModel->createNewUser($newUser);
        if ($checkUser) {
            $getUserDb = $this->user->getUser();
            $this->sessionStart($getUserDb);
        }
    }


    public function sessionStart($user) :void
    {
        var_dump($user);
        $_SESSION['userId'] = $user['id'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['lastLoginAt'] = $user['lastLoginAt'];
        header('Location: http://localhost/TP11_online_advisor_phppoo/items/listItemPage');
    }


    public function sessionDestroy() :void
    {
        session_destroy();
        header('Location: http://localhost/TP11_online_advisor_phppoo');
    }
}
