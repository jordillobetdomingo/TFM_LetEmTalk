<?php


namespace App\Component\ApiLet\Domain\User\Entity;


class User
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;

    public function __construct(int $id, string $firstName, string $lastName, string $email)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }
}