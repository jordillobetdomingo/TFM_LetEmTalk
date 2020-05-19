<?php


namespace LetEmTalk\Component\Domain\Authentication\Entity;


use LetEmTalk\Component\Domain\User\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCredentials implements UserInterface
{
    private string $username;
    private string $password;
    private User $user;

    public function __construct(string $username, string $password, User $user)
    {
        $this->username = $username;
        $this->password = $password;
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getRoles()
    {

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