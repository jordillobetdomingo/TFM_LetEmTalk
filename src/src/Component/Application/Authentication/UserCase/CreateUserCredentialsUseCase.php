<?php


namespace LetEmTalk\Component\ApiLet\Application\Authentication\UserCase;

use LetEmTalk\Component\Application\Authentication\Request\CreateUserCredentialsRequest;
use LetEmTalk\Component\Domain\Authentication\Entity\UserCredentials;
use LetEmTalk\Component\Domain\Authentication\Repository\UserCredentialsRepository;
use LetEmTalk\Component\Domain\Authentication\ValueObject\Password;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserCredentialsUseCase
{
    private UserCredentialsRepository $authenticationRepository;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(
        UserCredentialsRepository $authenticationRepository,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->authenticationRepository = $authenticationRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function execute(CreateUserCredentialsRequest $request): void
    {
        $userCredentials = new UserCredentials(
            $request->getUsername(),
            new Password($request->getPassword()),
            $request->getUserId(),
            $this->passwordEncoder
        );
        $this->authenticationRepository->save($userCredentials);
    }
}