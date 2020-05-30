<?php


namespace LetEmTalk\Bundle\Api\Controller\User;


use LetEmTalk\Component\ApiLet\Application\Authentication\UserCase\CreateUserCredentialsUseCase;
use LetEmTalk\Component\Application\Authentication\Request\CreateUserCredentialsRequest;
use LetEmTalk\Component\Application\User\Request\CreateUserRequest;
use LetEmTalk\Component\Application\User\UseCase\CreateUserUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{
    private CreateUserUseCase $createUserUseCase;
    private CreateUserCredentialsUseCase $createUserCredentialsUseCase;

    public function __construct(
        CreateUserUseCase $createUserUseCase,
        CreateUserCredentialsUseCase $createUserCredentialsUseCase
    ) {
        $this->createUserUseCase = $createUserUseCase;
        $this->createUserCredentialsUseCase = $createUserCredentialsUseCase;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $firstName = $json["first_name"];
        $lastName = $json["last_name"];
        $email = $json["email"];

        $userResponse = $this->createUserUseCase->execute(new CreateUserRequest($firstName, $lastName, $email));

        if (isset($json["username"]) && isset($json["password"])) {
            $this->createUserCredentialsUseCase->execute(
                new CreateUserCredentialsRequest($json["username"], $json["password"], $userResponse->getUser()->getId())
            );
        }

        return new Response("Have saved a user", 204);
    }
}