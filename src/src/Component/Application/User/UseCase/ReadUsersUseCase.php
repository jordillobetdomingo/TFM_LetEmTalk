<?php


namespace LetEmTalk\Component\Application\User\UseCase;


use LetEmTalk\Component\Application\User\Response\ReadUsersResponse;
use LetEmTalk\Component\Domain\User\Repository\UserOwnRepository;

class ReadUsersUseCase
{
    private UserOwnRepository $userRepository;

    public function __construct(UserOwnRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(): ReadUsersResponse
    {
        return new ReadUsersResponse($this->userRepository->findAllUsers());
    }
}