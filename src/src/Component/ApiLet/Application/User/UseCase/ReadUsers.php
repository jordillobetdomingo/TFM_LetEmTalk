<?php


namespace App\Component\ApiLet\Application\User\UseCase;


use App\Component\ApiLet\Application\User\Response\ReadUsersResponse;
use App\Component\ApiLet\Domain\User\Repository\UserRepository;

class ReadUsers
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(): ReadUsersResponse
    {
        return new ReadUsersResponse($this->userRepository->findAllUsers());
    }
}