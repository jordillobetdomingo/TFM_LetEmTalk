<?php


namespace LetEmTalk\Component\Domain\Authentication\Entity;


use LetEmTalk\Component\Domain\User\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCredentials implements UserInterface
{
    private string $username;
    private string $password;
    private User $user;

    public function __construct(string $username, string $password, User $user, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->username = $username;
        $this->password = $passwordEncoder->encodePassword($this, $password);
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