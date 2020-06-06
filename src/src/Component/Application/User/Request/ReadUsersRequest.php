<?php


namespace LetEmTalk\Component\Application\User\Request;


class ReadUsersRequest
{
    private int $userIdentified;

    public function __construct(int $userIdentified)
    {
        $this->userIdentified = $userIdentified;
    }

    public function getUserIdentified(): int
    {
        return $this->userIdentified;
    }

}