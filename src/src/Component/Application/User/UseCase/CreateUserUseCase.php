<?php


namespace LetEmTalk\Component\Application\User\UseCase;


use LetEmTalk\Component\Application\User\Request\CreateUserRequest;
use LetEmTalk\Component\Application\User\Response\CreateUserResponse;
use LetEmTalk\Component\Domain\Authorization\Service\AdminAuthorization;
use LetEmTalk\Component\Domain\User\Entity\User;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;
use LetEmTalk\Component\Domain\User\ValueObject\Email;

class CreateUserUseCase
{
    private UserRepository $userRepository;
    private AdminAuthorization $adminAuthorization;

    public function __construct(UserRepository $userRepository, AdminAuthorization $adminAuthorization)
    {
        $this->userRepository = $userRepository;
        $this->adminAuthorization = $adminAuthorization;
    }

    public function execute(CreateUserRequest $request): CreateUserResponse
    {
        if (!$this->adminAuthorization->isAdmin($request->getUserIdentified()))
        {
            throw new \InvalidArgumentException();
        }

        $user = new User($request->getFirstName(), $request->getLastName(), new Email($request->getEmail()));
        $this->userRepository->save($user);
        return new CreateUserResponse($user);
    }
}