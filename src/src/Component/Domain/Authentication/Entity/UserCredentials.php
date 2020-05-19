<?php


namespace LetEmTalk\Component\Domain\Authentication\Entity;


use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCredentials implements UserInterface
{
    private string $username;
    private string $password;
    private int $userId;

    public function __construct(string $username, string $password, int $userId, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->username = $username;
        $this->password = $passwordEncoder->encodePassword($this, $password);
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getRoles(): array
    {
        return array();
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSalt()
    {

    }

    public function getUsername()
    {
        $this->username;
    }

    public function eraseCredentials()
    {

    }
}