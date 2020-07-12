<?php


namespace LetEmTalk\Bundle\Api\Controller\User;


use LetEmTalk\Component\Application\Authentication\UseCase\CreateUserCredentialsUseCase;
use LetEmTalk\Component\Application\Authentication\Request\CreateUserCredentialsRequest;
use LetEmTalk\Component\Application\User\Request\CreateUserRequest;
use LetEmTalk\Component\Application\User\UseCase\CreateUserUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class CreateUserController
{
    const INPUT_FIRST_NAME = 'firstName';
    const INPUT_LAST_NAME = 'lastName';
    const INPUT_EMAIL = 'email';
    const INPUT_USERNAME = 'username';
    const INPUT_PASSWORD = 'password';

    private CreateUserUseCase $createUserUseCase;
    private CreateUserCredentialsUseCase $createUserCredentialsUseCase;
    private Security $security;

    public function __construct(
        CreateUserUseCase $createUserUseCase,
        CreateUserCredentialsUseCase $createUserCredentialsUseCase,
        Security $security
    ) {
        $this->createUserUseCase = $createUserUseCase;
        $this->createUserCredentialsUseCase = $createUserCredentialsUseCase;
        $this->security = $security;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        if(!isset($json[self::INPUT_FIRST_NAME]) || !isset($json[self::INPUT_LAST_NAME])
            || !isset($json[self::INPUT_EMAIL])) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        $firstName = $json[self::INPUT_FIRST_NAME];
        $lastName = $json[self::INPUT_LAST_NAME];
        $email = $json[self::INPUT_EMAIL];

        try {
            $userResponse = $this->createUserUseCase->execute(
                new CreateUserRequest($firstName, $lastName, $email, $user->getUserId())
            );

            if (isset($json[self::INPUT_USERNAME]) && isset($json[self::INPUT_PASSWORD])) {
                $this->createUserCredentialsUseCase->execute(
                    new CreateUserCredentialsRequest(
                        $json[self::INPUT_USERNAME],
                        $json[self::INPUT_PASSWORD],
                        $userResponse->getUser()->getId(),
                        $user->getUserId()
                    )
                );
            }
            return new JsonResponse($userResponse->getUserAsArray(), Response::HTTP_OK);
        } catch (\InvalidArgumentException $argumentException) {
            return new Response("", Response::HTTP_UNAUTHORIZED);
        }
    }
}