<?php

namespace App\Model;

use Exception;

final class UserModel
{
    private object $dataBase;

    public function __construct()
    {
        $pdo = new ConnectModel();
        $this->dataBase = $pdo->dbConnect();
    }

    public function checkUserExist(string $userLogin, string $mail): bool
    {
        $req = $this->dataBase->prepare('SELECT 
        id, user_login, mail, pass FROM user  
        WHERE user_login = ? OR mail = ?');
        $req->execute(array($userLogin,$mail));
        $post = $req->fetch();

        if ($post) {
            return true;
        }
        return false;
    }

    public function createNewUser(array $user): bool
    {
        if ($this->checkUserExist($user['login'], $user['mail']) === false) {
            $newUser = $this->dataBase->prepare('INSERT INTO 
            user (user_login, mail, pass, last_login_at) 
            VALUES(?, ?, ?, ?)');

            return $newUser->execute(array($user['login'], $user['mail'],
            $user['pass'], $user['lastLoginAt']));
        }
        throw new Exception('Login ou Mail déjà utilisé');
    }

    public function getUserDb(string $userLogin): array
    {
        $req = $this->dataBase->prepare('SELECT 
        id, user_login, mail, pass, last_login_at FROM user  
        WHERE user_login = ?');
        $req->execute(array($userLogin));
        $user = $req->fetch();

        if ($user) {
            return $user;
        }
        throw new Exception('Login inexistant');
    }

    public function updateUserDateLog(array $user): bool
    {
        $req = $this->dataBase->prepare('UPDATE user 
        SET last_login_at = ? WHERE user_login = ?');
        $req->execute(array($user['lastLoginAt'], $user['login']));
        return $req->fetch();
    }

    public function deleteUser(string $userLogin): bool
    {
        $req = $this->dataBase->prepare('DELETE FROM item  WHERE id = ?');
        $req->execute(array($userLogin));
        return $req->fetch();
    }
}
