<?php


namespace LetEmTalk\Component\Application\Chat\Request;


class UpdatePillRequest
{
    private int $pillId;
    private string $text;
    private int $userId;

    public function __construct(int $pillId, string $text, int $userId)
    {
        $this->pillId = $pillId;
        $this->text = $text;
        $this->userId = $userId;
    }

    public function getPillId(): int
    {
        return $this->pillId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}