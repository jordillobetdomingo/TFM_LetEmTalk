<?php


namespace LetEmTalk\Component\Application\User\UseCase;


use LetEmTalk\Component\Application\User\Request\ReadUsersRequest;
use LetEmTalk\Component\Application\User\Response\ReadUsersResponse;
use LetEmTalk\Component\Domain\Authorization\Service\AdminAuthorization;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class ReadUsersUseCase
{
    private UserRepository $userRepository;
    private AdminAuthorization $adminAuthorization;

    public function __construct(UserRepository $userRepository, AdminAuthorization $adminAuthorization)
    {
        $this->userRepository = $userRepository;
        $this->adminAuthorization = $adminAuthorization;
    }

    public function execute(ReadUsersRequest $request): ReadUsersResponse
    {
        if(!$this->adminAuthorization->isAdmin($request->getUserIdentified())) {
            throw new \InvalidArgumentException();
        }

        return new ReadUsersResponse($this->userRepository->findAllUsers());
    }
}