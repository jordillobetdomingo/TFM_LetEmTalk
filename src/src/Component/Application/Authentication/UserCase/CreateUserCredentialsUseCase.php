<?php


namespace LetEmTalk\Component\ApiLet\Application\Authentication\UserCase;

use LetEmTalk\Component\Application\Authentication\Request\CreateUserCredentialsRequest;
use LetEmTalk\Component\Domain\Authentication\Entity\UserCredentials;
use LetEmTalk\Component\Domain\Authentication\Repository\UserCredentialsRepository;

class CreateUserCredentialsUseCase
{
    private UserCredentialsRepository $authenticationRepository;

    public function __construct(UserCredentialsRepository $authenticationRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
    }

    public function execute(CreateUserCredentialsRequest $request): void
    {
        $userCredentials = new UserCredentials($request->getUsername(), $request->getPassword(), $request->getUser());
        $this->authenticationRepository->save($userCredentials);
    }
}