<?php


namespace App\Component\ApiLet\Domain\AuthenticationLet\Entity;


use App\Component\ApiLet\Domain\User\Entity\User;

class Authentication
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

    public function getUser(): User
    {
        return $this->user;
    }
}