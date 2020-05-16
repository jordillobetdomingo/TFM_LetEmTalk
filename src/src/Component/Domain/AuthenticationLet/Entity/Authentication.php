<?php


namespace LetEmTalk\Component\Domain\AuthenticationLet\Entity;


use LetEmTalk\Component\Domain\User\Entity\User;

class Authentication
{
    private string $username;
    private string $password;
    private User $user;

    public function __construct(string $username, string $password, User $user)
    {
        $this->username = $username;
        $this->password = $password;
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}