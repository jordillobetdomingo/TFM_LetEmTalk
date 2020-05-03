<?php


namespace App\Component\ApiLet\Application\User\Request;


class LoginRequest
{
    private $username;
    private $password;

    pubilc function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername(): string
    {
        $this->username;
    }

    public function getPassword(): string
    {
        $this->password;
    }
}