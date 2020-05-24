<?php


namespace LetEmTalk\Component\Application\Chat\Request;


use LetEmTalk\Component\Domain\User\Entity\User;

class CreateRoomRequest
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

}