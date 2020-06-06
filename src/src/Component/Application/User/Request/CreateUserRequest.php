<?php


namespace LetEmTalk\Component\Application\User\Request;


class CreateUserRequest
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private int $userIdentified;

    public function __construct(string $firstName, string $lastName, string $email, int $userIdentified)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->userIdentified = $userIdentified;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUserIdentified(): int
    {
        return $this->userIdentified;
    }
}