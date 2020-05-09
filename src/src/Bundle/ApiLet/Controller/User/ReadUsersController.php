<?php


namespace App\Bundle\ApiLet\Controller\User;


use App\Component\ApiLet\Application\User\UseCase\ReadUsers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReadUsersController
{
    private $readUsers;

    public function __construct(ReadUsers $readUsers)
    {
        $this->readUsers = $readUsers;
    }

    public function execute(): Response
    {
        $response = $this->readUsers->execute();
        return new JsonResponse($response->getUsersAsArray());
    }
}