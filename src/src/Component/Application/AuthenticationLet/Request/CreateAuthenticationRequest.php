<?php


namespace LetEmTalk\Component\Application\AuthenticationLet\Request;


use LetEmTalk\Component\Domain\User\Entity\User;

class CreateAuthenticationRequest
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

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}