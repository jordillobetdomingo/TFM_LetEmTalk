<?php


namespace LetEmTalk\Component\Application\User\Response;


use LetEmTalk\Component\Domain\User\Entity\User;

class ReadUsersResponse
{
    private array $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function getUsersAsArray(): array
    {
        return array_map(function($user) {
            return $this->getUserAsArray($user);
        }, $this->users);
    }

    private function getUserAsArray(User $user): array
    {
        return [
            "id" => $user->getId(),
            "first_name" => $user->getFirstName(),
            "last_name" => $user->getLastName(),
            "email" => $user->getEmail()
        ];
    }
}