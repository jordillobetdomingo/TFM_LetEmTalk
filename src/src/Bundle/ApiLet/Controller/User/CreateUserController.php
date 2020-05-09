<?php


namespace App\Bundle\ApiLet\Controller\User;


use App\Component\ApiLet\Application\User\Request\CreateUserRequest;
use App\Component\ApiLet\Application\User\UseCase\CreateUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{
    private $createUser;

    public function __construct(CreateUser $createUser)
    {
        $this->createUser = $createUser;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $id = $json["id"];
        $first_name = $json["first_name"];
        $last_name = $json["last_name"];
        $email = $json["email"];

        $this->createUser->execute(new CreateUserRequest($id, $first_name, $last_name, $email));

        return new Response("Have saved a user");
    }
}