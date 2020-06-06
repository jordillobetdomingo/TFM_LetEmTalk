<?php


namespace LetEmTalk\Component\Application\Authentication\Request;


class CreateUserCredentialsRequest
{
    private string $username;
    private string $password;
    private int $userId;
    private int $userIdentified;

    public function __construct(string $username, string $password, int $userId, int $userIdentified)
    {
        $this->username = $username;
        $this->password = $password;
        $this->userId = $userId;
        $this->userIdentified = $userIdentified;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUserIdentified(): int
    {
        return $this->userIdentified;
    }
}