<?php


namespace LetEmTalk\Component\Application\User\UseCase;


use LetEmTalk\Component\Application\User\Request\DeleteUserRequest;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class DeleteUserUseCase
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(DeleteUserRequest $request)
    {
        $this->userRepository->delete($request->getUserId());
    }
}