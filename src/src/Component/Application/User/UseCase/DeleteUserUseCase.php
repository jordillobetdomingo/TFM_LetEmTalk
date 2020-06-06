<?php


namespace LetEmTalk\Component\Application\User\UseCase;


use LetEmTalk\Component\Application\User\Request\DeleteUserRequest;
use LetEmTalk\Component\Domain\Authorization\Service\AdminAuthorization;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class DeleteUserUseCase
{
    private UserRepository $userRepository;
    private AdminAuthorization $adminAuthorization;

    public function __construct(UserRepository $userRepository, AdminAuthorization $adminAuthorization)
    {
        $this->userRepository = $userRepository;
        $this->adminAuthorization = $adminAuthorization;
    }

    public function execute(DeleteUserRequest $request)
    {
        if (!$this->adminAuthorization->isAdmin($request->getUserIdentified())) {
            throw new \InvalidArgumentException();
        }
        $this->userRepository->delete($request->getUserId());
    }
}