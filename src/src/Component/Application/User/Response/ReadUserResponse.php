<?php


namespace LetEmTalk\Component\Application\User\Response;


use LetEmTalk\Component\Domain\Authorization\Service\AdminAuthorization;
use LetEmTalk\Component\Domain\User\Entity\User;

class ReadUserResponse
{
    private User $user;
    private AdminAuthorization $adminAuthorization;

    public function __construct(User $user, AdminAuthorization $adminAuthorization)
    {
        $this->user = $user;
        $this->adminAuthorization = $adminAuthorization;
    }

    public function getUserAsArray(): array
    {
        return [
            "id" => $this->user->getId(),
            "firstName" => $this->user->getFirstName(),
            "lastName" => $this->user->getLastName(),
            "isAdmin" => $this->adminAuthorization->isAdmin($this->user->getId())
        ];
    }
}