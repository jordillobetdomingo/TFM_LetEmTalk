<?php


namespace LetEmTalk\Component\Application\User\Response;


use LetEmTalk\Component\Domain\User\Entity\User;

class CreateUserResponse
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