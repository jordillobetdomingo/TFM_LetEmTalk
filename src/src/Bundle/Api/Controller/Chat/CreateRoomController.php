<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\CreateRoomRequest;
use LetEmTalk\Component\Application\Chat\UseCase\CreateRoomUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateRoomController
{
    private CreateRoomUseCase $createRoomUseCase;

    public function __construct(CreateRoomUseCase $createRoomUseCase)
    {
        $this->createRoomUseCase = $createRoomUseCase;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $userId = $json["userId"];
        $this->createRoomUseCase->execute(new CreateRoomRequest($userId));

        return new Response("Repository has been created", 204);
    }
}