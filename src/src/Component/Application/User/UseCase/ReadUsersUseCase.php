<?php


namespace LetEmTalk\Component\Application\User\UseCase;


use LetEmTalk\Component\Application\User\Response\ReadUsersResponse;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class ReadUsersUseCase
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(): ReadUsersResponse
    {
        return new ReadUsersResponse($this->userRepository->findAllUsers());
    }
}