<?php


namespace LetEmTalk\Bundle\Api\Controller\User;


use LetEmTalk\Component\Application\User\UseCase\ReadUsersUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReadUsersController
{
    private ReadUsersUseCase $readUsersUseCase;

    public function __construct(ReadUsersUseCase $readUsersUseCase)
    {
        $this->readUsersUseCase = $readUsersUseCase;
    }

    public function execute(): Response
    {
        $response = $this->readUsersUseCase->execute();
        return new JsonResponse($response->getUsersAsArray());
    }
}