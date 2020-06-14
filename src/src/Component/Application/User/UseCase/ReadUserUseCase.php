<?php


namespace LetEmTalk\Component\Application\User\UseCase;

use LetEmTalk\Component\Application\User\Request\ReadUserRequest;
use LetEmTalk\Component\Application\User\Response\ReadUserResponse;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class ReadUserUseCase
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(ReadUserRequest $request): ReadUserResponse
    {
        $user = $this->userRepository->getUser($request->getUserId());

        return new ReadUserResponse($user);
    }

}