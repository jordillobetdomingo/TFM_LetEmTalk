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

    public function getUserAsArray(): array
    {
        return [
            "id" => $this->user->getId(),
            "firstName" => $this->user->getFirstName(),
            "lastName" => $this->user->getLastName(),
            "email" => $this->user->getEmail()->getEmail()
        ];
    }
}