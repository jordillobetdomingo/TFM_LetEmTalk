<?php


namespace LetEmTalk\Component\Application\User\Request;


class DeleteUserRequest
{
    private int $userId;
    private int $userIdentified;

    public function __construct(int $userId, int $userIdentified)
    {
        $this->userId = $userId;
        $this->userIdentified = $userIdentified;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUserIdentified(): int
    {
        return $this->userIdentified;
    }
}