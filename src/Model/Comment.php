<?php

namespace App\Model;

use Exception;

final class Comment
{
    private const PATTERN_COMMENT = "/^[a-zA-Z0-9À-ÿ .,?!'&()-]{2,255}$/";
    private int $itemId = 0;
    private int $userId = 0;
    private string $comment = '';
    private string $dateCreation = '';

    public function __construct()
    {
        $this->setDateCreation();
    }

    public function setItemId(int $itemId): int
    {
        if (! is_int($itemId) || $itemId < 1) {
            throw new Exception('Item Id invalide');
        }
        $this->itemId = $itemId;

        return $this->itemId;
    }

    public function setUserId(int $userId): int
    {
        $userId = (int) $userId;
        if (! is_int($userId) || $userId < 1) {
            throw new Exception('User Id invalide');
        }
        $this->userId = $userId;

        return $this->userId;
    }

    public function setComment(string $comment): string
    {
        $pattern = self::PATTERN_COMMENT;
        //$comment = htmlspecialchars($comment);
        if (! preg_match($pattern, $comment)) {
            throw new Exception('Le commentaire est invalide');
        }
        $this->comment = $comment;

        return $this->comment;
    }

    public function setDateCreation(): string
    {
        $this->dateCreation = date('Y-m-d H:i:s');

        return $this->dateCreation;
    }

    public function getComment(): array
    {
        return array(
                'itemId' => $this->itemId,
                'userId' => $this->userId,
                'comment' => $this->comment,
                'dateCreation' => $this->dateCreation

        );
    }

    public function checkNewComment(array $newcomment, array $sessionComment): array
    {
        if ($this->setComment($newcomment['comment'])
        && $this->setItemId($sessionComment['itemId'])
        && $this->setUserId($sessionComment['userId'])) {
            return $this->getComment();
        }
        throw new Exception('Format incorrect');
    }
}
