<?php

namespace App\Model;

use Exception;

final class Item
{
    private const PATTERN_ITEMNAME = "/^[a-zA-Z0-9À-ÿ .'&()-]{2,50}$/";
    private const PATTERN_CATEGORY = '/^[a-zA-Z0-9À-ÿ .-]{2,30}$/';
    private const PATTERN_REVIEW = "/^[a-zA-Z0-9À-ÿ .,?!'&()-]{2,255}$/";
    private string $itemName;
    private string $category = '';
    private int $rate = 1;
    private string $review = '';
    private int $userId = 0;
    private string $dateCreation;

    public function __construct(string $itemName)
    {
        $this->setItemName($itemName);
        $this->setDateCreation();
    }

    public function setItemName(string $itemName): string
    {
        $pattern = self::PATTERN_ITEMNAME;
        if (! preg_match($pattern, $itemName)) {
            throw new Exception('Le titre est invalide');
        }
        $this->itemName = $itemName;

        return $this->itemName;
    }

    public function setCategory(string $category): string
    {
        $pattern = self::PATTERN_CATEGORY;
        if (! preg_match($pattern, $category)) {
            throw new Exception('La categorie est invalide');
        }
        $this->category = $category;

        return $this->category;
    }

    public function setRate(int $rate): int
    {
        if (! is_int($rate) || $rate <= 0 || $rate > 5) {
            throw new Exception('Note invalide');
        }
        $this->rate = $rate;

        return $this->rate;
    }

    public function setReview(string $review): string
    {
        $pattern = self::PATTERN_REVIEW;
        if (! preg_match($pattern, $review)) {
            throw new Exception('Le commentaire est invalide');
        }
        $this->review = $review;

        return $this->review;
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

    public function setDateCreation(): string
    {
        $this->dateCreation = date('Y-m-d H:i:s');

        return $this->dateCreation;
    }

    public function getItem(): array
    {
        return array(
            'itemName' => $this->itemName,
            'category' => $this->category,
            'rate' => $this->rate,
            'review' => $this->review,
            'userId' => $this->userId,
            'dateCreation' => $this->dateCreation
        );
    }

    public function checkNewItem(array $item, array $sessionItem): array
    {
        if ($this->setCategory($item['category'])
        && $this->setRate($item['rate'])
        && $this->setReview($item['review'])
        && $this->setUserId($sessionItem['userId'])) {
            return $this->getItem();
        }
        throw new Exception('Format incorrect');
    }
}
