<?php


namespace LetEmTalk\Component\Application\User\UseCase;


use LetEmTalk\Component\Application\User\Request\CreateUserRequest;
use LetEmTalk\Component\Application\User\Response\CreateUserResponse;
use LetEmTalk\Component\Domain\User\Entity\User;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;
use LetEmTalk\Component\Domain\User\ValueObject\Email;

class CreateUserUseCase
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(CreateUserRequest $request): CreateUserResponse
    {
        $user = new User($request->getFirstName(), $request->getLastName(), new Email($request->getEmail()));

        $this->userRepository->save($user);

        return new CreateUserResponse($user);
    }
}