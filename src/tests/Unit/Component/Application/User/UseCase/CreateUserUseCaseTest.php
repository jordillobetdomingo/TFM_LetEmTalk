<?php

namespace LetEmTalk\Tests\Unit\Component\Application\User\UseCase;

use LetEmTalk\Component\Application\User\Request\CreateUserRequest;
use LetEmTalk\Component\Application\User\Response\CreateUserResponse;
use LetEmTalk\Component\Application\User\UseCase\CreateUserUseCase;
use LetEmTalk\Component\Domain\Authorization\Service\AdminAuthorization;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class CreateUserUseCaseTest extends TestCase
{
    const EMAIL = "example@example.com";

    private UserRepository $userRepository;
    private AdminAuthorization $adminAuthorization;
    private CreateUserRequest $createUserRequest;
    private CreateUserUseCase $createUserUseCase;

    protected function setUp() : void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->adminAuthorization = $this->createMock(AdminAuthorization::class);
        $this->createUserRequest = $this->createMock(CreateUserRequest::class);
        $this->createUserUseCase = new CreateUserUseCase($this->userRepository, $this->adminAuthorization);
    }

    /** @test */
    public function shouldExecuteCreateUserUseCase()
    {
        $this->givenAdminAuthorization();
        $this->thenExpectExecuteCreateUserRequestsMethods();
        $this->thenExpectExecuteUserRepositoryMethods();
        $this->whenExecuteCreateUserUseCaseAndCreateACreateUserResponse();
    }

    /** @test */
    public function shouldNotPermissionExecuteCreateUserUseCase()
    {
        $this->givenNotAdminAuthorization();
        $this->thenExpectInvalidArgumentException();
        $this->whenExecuteCreateUserUseCase();
    }

    private function givenAdminAuthorization(): void
    {
        $this->adminAuthorization->method("isAdmin")->willReturn(true);
    }

    private function givenNotAdminAuthorization(): void
    {
        $this->adminAuthorization->method("isAdmin")->willReturn(false);
    }

    private function thenExpectExecuteCreateUserRequestsMethods(): void
    {
        $this->createUserRequest->expects($this->once())->method("getUserIdentified");
        $this->createUserRequest->expects($this->once())->method("getFirstName");
        $this->createUserRequest->expects($this->once())->method("getLastName");
        $this->createUserRequest->expects($this->once())->method("getEmail")->willReturn(self::EMAIL);
    }

    private function thenExpectInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);
    }

    private function thenExpectExecuteUserRepositoryMethods(): void
    {
        $this->userRepository->expects($this->once())->method("save");
    }

    private function whenExecuteCreateUserUseCase(): void
    {
        $this->createUserUseCase->execute($this->createUserRequest);
    }

    private function whenExecuteCreateUserUseCaseAndCreateACreateUserResponse(): void
    {
        $this->assertInstanceOf(CreateUserResponse::class, $this->createUserUseCase->execute($this->createUserRequest));
    }
}
