<?php


namespace LetEmTalk\Component\Domain\Authentication\ValueObject;


class Password
{
    const MINIMUM_LENGTH_PASSWORD = 8;

    private string $password;

    public function __construct(string $password)
    {
        // Minimum length
        if (strlen($password) < self::MINIMUM_LENGTH_PASSWORD) {
            throw new \InvalidArgumentException();
        }
        // Password no contain a digit
        if (!preg_match('/\d/', $password)) {
            throw new \InvalidArgumentException();
        }
        // Password no contain a letter
        if (!preg_match('/[a-zA-Z]/', $password))
        {
            throw new \InvalidArgumentException();
        }
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}