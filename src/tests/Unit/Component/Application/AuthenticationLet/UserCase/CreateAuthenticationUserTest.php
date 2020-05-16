<?php

namespace App\Tests\Component\ApiLet\Application\AuthenticationLet\UserCase;

use App\Component\ApiLet\Application\AuthenticationLet\Request\CreateAuthenticationRequest;
use App\Component\ApiLet\Application\AuthenticationLet\UserCase\CreateAuthenticationUser;
use App\Component\ApiLet\Domain\AuthenticationLet\Repository\AuthenticationRepository;
use App\Component\ApiLet\Domain\User\Entity\User;
use PHPUnit\Framework\TestCase;

class CreateAuthenticationUserTest extends TestCase
{
    private $createAuthenticationUser;
    private $createAuthenticationRequest;
    private $authenticationRepository;

    protected function setUp(): void
    {
        $this->createAuthenticationRequest = $this->createMock(CreateAuthenticationRequest::class);
        $this->authenticationRepository = $this->createMock(AuthenticationRepository::class);
        $this->createAuthenticationUser = new CreateAuthenticationUser($this->authenticationRepository);
    }

    protected function tearDown(): void
    {
        $this->createAuthenticationUserRequest = null;
        $this->authenticationRepository = null;
        $this->createAuthenticationUser = null;
    }

    /** @test */
    public function shouldSaveAAuthentication(): void
    {
        $this->givenACreateAuthenticationUserRequest();
        $this->thenSaveAuthenticationUserWhenExecutedCreateAuthenticationUser();
    }

    private function givenACreateAuthenticationUserRequest(): void
    {
        $this->createAuthenticationRequest->method("getUsername")->willReturn("test");
        $this->createAuthenticationRequest->method("getPassword")->willReturn("passwordtest");
        $this->createAuthenticationRequest->method("getUser")->willReturn($this->createMock(User::class));
    }

    private function thenSaveAuthenticationUserWhenExecutedCreateAuthenticationUser()
    {
        $this->authenticationRepository->expects($this->once())->method("save");
        $this->createAuthenticationUser->execute($this->createAuthenticationRequest);
    }
}
