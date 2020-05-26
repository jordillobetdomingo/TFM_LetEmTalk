<?php


namespace LetEmTalk\Component\Domain\User\Entity;


use LetEmTalk\Component\Domain\User\ValueObject\Email;

class User
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private Email $email;

    public function __construct(string $firstName, string $lastName, Email $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }
}