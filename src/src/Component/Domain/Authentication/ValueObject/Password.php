<?php


namespace LetEmTalk\Component\Domain\Authentication\ValueObject;


class Password
{
    private string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}