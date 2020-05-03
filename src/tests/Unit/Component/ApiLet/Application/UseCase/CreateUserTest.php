<?php

namespace App\Tests\Component\ApiLet\Application\UseCase;

use App\Component\ApiLet\Application\Request\CreateUserRequest;
use App\Component\ApiLet\Application\UseCase\CreateUser;
use App\Component\ApiLet\Domain\User\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{
    private $userRepository;
    private $createUserRequest;
    private $createUser;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->createUserRequest = $this->createMock(CreateUserRequest::class);
        $this->createUser = new CreateUser($this->userRepository);
    }

    protected function tearDown(): void
    {
        $this->userRepository = null;
        $this->createUserRequest = null;
        $this->createUser = null;
    }

    /** @test */
    public function shouldSaveAUser()
    {
        $this->givenACreateUserRequest();
        $this->thenSaveUserWhenExecuteUseCase();
    }

    private function givenACreateUserRequest(): void
    {
        $this->createUserRequest->method("getId")->willReturn(1);
        $this->createUserRequest->method("getFirstName")->willReturn("Joan");
        $this->createUserRequest->method("getLastName")->willReturn("Garcia");
        $this->createUserRequest->method("getEmail")->willReturn("example@example.com");
    }

    private function thenSaveUserWhenExecuteUseCase()
    {
        $this->userRepository->expects($this->once())->method("save");
        $this->createUser->execute($this->createUserRequest);
    }

}
