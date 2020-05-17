<?php


namespace LetEmTalk\Component\Application\User\UseCase;


use LetEmTalk\Component\Application\User\Request\CreateUserRequest;
use LetEmTalk\Component\Domain\User\Entity\User;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class CreateUserUseCase
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(CreateUserRequest $request)
    {
        $user = new User($request->getId(), $request->getFirstName(), $request->getLastName(), $request->getEmail());

        $this->userRepository->save($user);
    }
}