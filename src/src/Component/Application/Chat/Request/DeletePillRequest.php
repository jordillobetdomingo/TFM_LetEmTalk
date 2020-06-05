<?php


namespace LetEmTalk\Component\Application\Chat\Request;


class DeletePillRequest
{
    private int $pillId;
    private int $userId;

    public function __construct(int $pillId, int $userId)
    {
        $this->pillId = $pillId;
        $this->userId = $userId;
    }

    public function getPillId(): int
    {
        return $this->pillId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}