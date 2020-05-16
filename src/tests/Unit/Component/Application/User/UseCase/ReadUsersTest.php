<?php

namespace App\Tests\Component\ApiLet\Application\User\UseCase;

use App\Component\ApiLet\Application\User\Response\ReadUsersResponse;
use App\Component\ApiLet\Application\User\UseCase\ReadUsersUseCase;
use App\Component\ApiLet\Domain\User\Entity\User;
use App\Component\ApiLet\Domain\User\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class ReadUsersTest extends TestCase
{
    private $userRepository;
    private $readUsers;
    private $userOne;
    private $userTwo;

    protected function setUp(): void
    {
        $this->userOne = $this->createMock(User::class);
        $this->userTwo = $this->createMock(User::class);
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->readUsers = new ReadUsersUseCase($this->userRepository);
    }

    protected function tearDown(): void
    {
        $this->userOne = null;
        $this->userTwo = null;
        $this->readUsers = null;
        $this->userRepository = null;
    }

    /** @test */
    public function shouldReturnEmptyArrayWhenNoExistUsers(): void
    {
        $this->givenAnEmptyRepository();
        $this->thenReturnAnEmptyArray();
    }

    /** @test */
    public function shouldReturnArrayWithOneUserWhenExistOneUser(): void
    {
        $this->givenARepositoryWithOneUser();
        $this->thenReturnArrayWithOneUser();
    }

    /** @test */
    public function shouldReturnArrayWithTwoUsersWhenExistTwoUsers(): void
    {
        $this->givenARepositoryWithTwoUsers();
        $this->thenReturnArrayWithTwoUsers();
    }

    private function givenAnEmptyRepository(): void
    {
        $this->userRepository->method("findAllUsers")->willReturn(array());
    }

    private function givenARepositoryWithOneUser(): void
    {
        $this->userRepository->method("findAllUsers")->willReturn(array($this->userOne));
    }

    private function givenARepositoryWithTwoUsers(): void
    {
        $this->userRepository->method("findAllUsers")->willReturn(array($this->userOne, $this->userTwo));
    }

    private function thenReturnAnEmptyArray(): void
    {
        $this->assertEquals(new ReadUsersResponse(array()), $this->readUsers->execute());
    }

    private function thenReturnArrayWithOneUser(): void
    {
        $this->assertEquals(new ReadUsersResponse(array($this->userOne)), $this->readUsers->execute());
    }

    private function thenReturnArrayWithTwoUsers(): void
    {
        $this->assertEquals(new ReadUsersResponse(array($this->userOne, $this->userTwo)), $this->readUsers->execute());
    }
}
