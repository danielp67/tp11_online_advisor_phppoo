<?php

namespace App\Model;

use Exception;

final class User
{
    private const PATTERN_MAIL = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
    private const PATTERN_USERLOGIN = '/^[a-zA-Z0-9À-ÿ_.-]{2,16}$/';
    private const PATTERN_PASS = '/^[a-zA-Z0-9_]{6,12}$/';
    private int $userId = 0;
    private string $userLogin;
    private string $pass = '';
    private string $mail = '';
    private string $lastLoginAt;

    public function __construct(string $userLogin)
    {
        $this->setUserLogin($userLogin);
        $this->setLastLoginAt();
    }

    //setters
    public function setUserId(int $userId): int
    {
        $userId = (int) $userId;
        if (! is_int($userId) || $userId < 1) {
            throw new Exception('User Id invalide');
        }
        $this->userId = $userId;

        return $this->userId;
    }

    public function setMail(string $mail): string
    {
        $pattern = self::PATTERN_MAIL;
        $mail = htmlspecialchars($mail);
        if (! preg_match($pattern, $mail)) {
            throw new Exception('mail est invalide');
        }
        $this->mail = $mail;

        return $this->mail;
    }

    public function setUserLogin(string $userLogin): string
    {
        $pattern = self::PATTERN_USERLOGIN;
        $userLogin = htmlspecialchars($userLogin);
        if (! preg_match($pattern, $userLogin)) {
            throw new Exception('Le pseudo ou login est invalide');
        }
        $this->userLogin = $userLogin;

        return $this->userLogin;
    }

    public function setPass($pass): string
    {
        $pattern = self::PATTERN_PASS;
        $pass = htmlspecialchars($pass);
        if (! preg_match($pattern, $pass)) {
            throw new Exception('pass est invalide');
        }
        $this->pass = password_hash($pass, PASSWORD_DEFAULT);

        return $this->pass;
    }

    public function setLastLoginAt(): string
    {
        $this->lastLoginAt = date('Y-m-d H:i:s');

        return $this->lastLoginAt;
    }

    //getters
    public function getUserLogin(): string
    {
        return $this->userLogin;
    }

    public function getUser(): array
    {
        return array(
            'id' => $this->userId,
            'login' => $this->userLogin,
            'mail' => $this->mail,
            'pass' => $this->pass,
            'lastLoginAt' => $this->lastLoginAt,
        );
    }

    //méthode check log user
    public function checkLogUser(string $passForm, array $user): bool
    {
        if (password_verify($passForm, $user['pass'])) {
            $this->setUserId($user['id']);
            $this->setMail($user['mail']);
            $this->setPass($passForm);

            return true;
        }
        throw new Exception('Erreur login ou mot de passe');
    }

    //méthode check new user
    public function checkNewUser(array $user): array
    {
        if ($this->setMail($user['mail'])
        && $this->setPass($user['pass'])
        && $user['pass'] === $user['pass2']) {
            return $this->getUser();
        }
        throw new Exception('Format incorrect');
    }
}
