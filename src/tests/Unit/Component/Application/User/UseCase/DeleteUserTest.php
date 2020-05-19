<?php

namespace LetEmTalk\Tests\Component\Application\User\UseCase;

use LetEmTalk\Component\Application\User\Request\DeleteUserRequest;
use LetEmTalk\Component\Application\User\UseCase\DeleteUserUseCase;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class DeleteUserTest extends TestCase
{
    private $userRepository;
    private $deleteUserRequest;
    private $deleteUser;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->deleteUserRequest = $this->createMock(DeleteUserRequest::class);
        $this->deleteUser = new DeleteUserUseCase($this->userRepository);
    }

    protected function tearDown(): void
    {
        $this->userRepository = null;
        $this->deleteUserRequest = null;
        $this->deleteUser = null;
    }

    /** @test */
    public function shouldDeleteAUser()
    {
        $this->givenADeleteUserRequest();
        $this->thenDeleteUserWhenExecuteUseCase();
    }

    private function givenADeleteUserRequest()
    {
        $this->deleteUserRequest->method("getUserId")->willReturn(4);
    }

    private function thenDeleteUserWhenExecuteUseCase()
    {
        $this->userRepository->expects($this->once())->method("delete");
        $this->deleteUser->execute($this->deleteUserRequest);
    }

}
