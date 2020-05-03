<?php

namespace App\Tests\Component\ApiLet\Application\UseCase;

use App\Component\ApiLet\Application\Request\DeleteUserRequest;
use App\Component\ApiLet\Application\UseCase\DeleteUser;
use App\Component\ApiLet\Domain\User\Repository\UserRepository;
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
        $this->deleteUser = new DeleteUser($this->userRepository);
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
