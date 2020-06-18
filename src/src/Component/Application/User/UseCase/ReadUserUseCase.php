<?php


namespace LetEmTalk\Component\Application\User\UseCase;

use LetEmTalk\Component\Application\User\Request\ReadUserRequest;
use LetEmTalk\Component\Application\User\Response\ReadUserResponse;
use LetEmTalk\Component\Domain\Authorization\Service\AdminAuthorization;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class ReadUserUseCase
{
    private UserRepository $userRepository;
    private AdminAuthorization $adminAuthorization;

    public function __construct(UserRepository $userRepository, AdminAuthorization $adminAuthorization)
    {
        $this->userRepository = $userRepository;
        $this->adminAuthorization = $adminAuthorization;
    }

    public function execute(ReadUserRequest $request): ReadUserResponse
    {
        $user = $this->userRepository->getUser($request->getUserId());

        return new ReadUserResponse($user, $this->adminAuthorization);
    }

}