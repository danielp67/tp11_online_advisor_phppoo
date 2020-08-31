<?php

namespace App\Controller ;

use App\Model\User;
use App\Model\UserModel;

use App\View;


class UserController {

    private $user;
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    

    public function logUser()
    {
        $this->user = new User($_POST['login']);
        $userLogin = $this->user->getUserLogin();
        
        var_dump($_POST);
        $getUserDb = $this->userModel->getUserDb($userLogin);

        $checkUser = $this->user->checkLogUser($_POST['pass'], $getUserDb);
        $getUserDb = $this->user->getUser();
        
        if($checkUser){
            $this->userModel->updateUserDateLog($getUserDb);
            $this->sessionStart($getUserDb);
        }
        
    }


    public function addNewUser()
    {
        $this->user = new User($_POST['login']);
        $newUser = $this->user->checkNewUser($_POST);

        $checkUser = $this->userModel->createNewUser($newUser);
        if($checkUser){
            $getUserDb = $this->userModel->getUserDb($newUser['login']);
            $this->sessionStart($getUserDb);
        }
    }


    public function sessionStart($user)
    {  
        var_dump($user);
        $_SESSION['userId'] = $user['id'];
       $_SESSION['login'] = $user['user_login'];
       $_SESSION['lastLoginAt'] = $user['last_login_at'];
       header('Location: http://localhost/TP11_online_advisor_phppoo/items/listItemPage');
    }


    public function sessionDestroy()
    {
        session_destroy();
        header('Location: http://localhost/TP11_online_advisor_phppoo');
    }


}
