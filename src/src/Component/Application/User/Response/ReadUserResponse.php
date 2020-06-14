<?php


namespace LetEmTalk\Component\Application\User\Response;


use LetEmTalk\Component\Domain\User\Entity\User;

class ReadUserResponse
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserAsArray(): array
    {
        return [
            "id" => $this->user->getId(),
            "firstName" => $this->user->getFirstName(),
            "lastName" => $this->user->getLastName()
        ];
    }
}