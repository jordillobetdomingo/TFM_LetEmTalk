<?php


namespace LetEmTalk\Bundle\Api\Controller\User;


use LetEmTalk\Component\Application\User\Request\CreateUserRequest;
use LetEmTalk\Component\Application\User\UseCase\CreateUserUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{
    private CreateUserUseCase $createUserUseCase;

    public function __construct(CreateUserUseCase $createUserUseCase)
    {
        $this->createUserUseCase = $createUserUseCase;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $id = $json["id"];
        $firstName = $json["first_name"];
        $lastName = $json["last_name"];
        $email = $json["email"];

        $this->createUserUseCase->execute(new CreateUserRequest($id, $firstName, $lastName, $email));

        return new Response("Have saved a user");
    }
}