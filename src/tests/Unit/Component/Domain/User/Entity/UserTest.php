<?php

namespace LetEmTalk\Tests\Component\Domain\User\Entity;

use LetEmTalk\Component\Domain\User\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    const ID_USER = 1;
    const FIRST_NAME_USER = "first_name";
    const LAST_NAME_USER = "last_name";
    const EMAIL_USER = "email";

    private $user;

    /** @test */
    public function shouldReturnTheSameAttributes()
    {
        $this->givenAUser();
        $this->thenReturnTheSameId();
        $this->thenReturnTheSameFirstName();
        $this->thenReturnTheSameLastName();
        $this->thenReturnTheSameEmail();
    }


    private function givenAUser()
    {
        $this->user = new User(self::ID_USER, self::FIRST_NAME_USER, self::LAST_NAME_USER, self::EMAIL_USER);
    }

    private function thenReturnTheSameId()
    {
        $this->assertEquals(self::ID_USER, $this->user->getId());
    }

    private function thenReturnTheSameFirstName()
    {
        $this->assertEquals(self::FIRST_NAME_USER, $this->user->getFirstName());
    }

    private function thenReturnTheSameLastName()
    {
        $this->assertEquals(self::LAST_NAME_USER, $this->user->getLastName());
    }

    private function thenReturnTheSameEmail()
    {
        $this->assertEquals(self::EMAIL_USER, $this->user->getEmail());
    }
}
