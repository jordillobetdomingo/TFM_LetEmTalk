<?php


namespace App\Component\ApiLet\Application\AuthenticationLet\Request;


use App\Component\ApiLet\Domain\User\Entity\User;

class CreateAuthenticationRequest
{
    private $username;
    private $password;
    private $user;

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