<?php


namespace LetEmTalk\Component\Application\Authentication\Request;


class CreateUserCredentialsRequest
{
    private string $username;
    private string $password;
    private int $userId;

    public function __construct(string $username, string $password, int $userId)
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

    public function getUser(): int
    {
        return $this->userId;
    }
}