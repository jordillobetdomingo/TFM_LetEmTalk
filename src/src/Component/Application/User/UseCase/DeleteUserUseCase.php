<?php


namespace LetEmTalk\Component\Application\User\UseCase;


use LetEmTalk\Component\Application\User\Request\DeleteUserRequest;
use LetEmTalk\Component\Domain\User\Repository\UserOwnRepository;

class DeleteUserUseCase
{
    private UserOwnRepository $userRepository;

    public function __construct(UserOwnRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(DeleteUserRequest $request)
    {
        $this->userRepository->delete($request->getUserId());
    }
}