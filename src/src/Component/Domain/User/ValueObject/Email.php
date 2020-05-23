<?php


namespace LetEmTalk\Component\Domain\User\ValueObject;


class Email
{
    private string $email;

    public function __construct(string $email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Email doesn't have a correct format");
        }
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}