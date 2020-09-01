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

    public function logUser(): void
    {
        $this->user = new User($_POST['login']);
        $userLogin = $this->user->getUserLogin();

        $getUserDb = $this->userModel->getUserDb($userLogin);

        $checkUser = $this->user->checkLogUser($_POST['pass'], $getUserDb);

        if ($checkUser) {
            $getUserDb = $this->user->getUser();
            $this->userModel->updateUserDateLog($getUserDb);
            $this->sessionStart($getUserDb);
        }
    }

    public function addNewUser(): void
    {
        $this->user = new User($_POST['login']);
        $newUser = $this->user->checkNewUser($_POST);

        $checkUser = $this->userModel->createNewUser($newUser);
        $getUserDb = $this->userModel->getUserDb($newUser['login']);

        $this->user->setUserId($getUserDb['id']);

        if ($checkUser) {
        $getUserDb = $this->user->getUser();
        $this->sessionStart($getUserDb);
        }
    }

    public function sessionStart($user): void
    {
        $_SESSION['userId'] = $user['id'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['lastLoginAt'] = $user['lastLoginAt'];
        header('Location: http://localhost/TP11_online_advisor_phppoo/items/listItemPage');
    }

    public function sessionDestroy(): void
    {
        session_destroy();
        header('Location: http://localhost/TP11_online_advisor_phppoo');
    }
}
