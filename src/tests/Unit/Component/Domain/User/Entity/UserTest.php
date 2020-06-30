<?php

namespace LetEmTalk\Tests\Unit\Component\Domain\User\Entity;

use LetEmTalk\Component\Domain\User\Entity\User;
use LetEmTalk\Component\Domain\User\ValueObject\Email;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    const TEST_FIRST_NAME = "Maria";
    const TEST_LAST_NAME = "Bonjoch";

    private $email;
    private $user;

    protected function setUp(): void
    {
        $this->email = $this->createMock(Email::class);
    }

    /** @test */
    public function shouldCreateAnUser()
    {
        $this->whenCreateAnUser();
        $this->thenWeHaveUserObject();
        $this->thenReturnValues();
    }

    private function whenCreateAnUser()
    {
        $this->user = new User(self::TEST_FIRST_NAME, self::TEST_LAST_NAME, $this->email);
    }

    private function thenWeHaveUserObject()
    {
        $this->assertInstanceOf(User::class, $this->user);
    }

    private function thenReturnValues()
    {
        $this->assertEquals(self::TEST_FIRST_NAME, $this->user->getFirstName());
        $this->assertEquals(self::TEST_LAST_NAME, $this->user->getLastName());
        $this->assertEquals($this->email, $this->user->getEmail());
    }

}
