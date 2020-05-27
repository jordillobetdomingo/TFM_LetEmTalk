<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\DeleteRoomRequest;
use LetEmTalk\Component\Application\Chat\UseCase\DeleteRoomUseCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteRoomController
{
    private DeleteRoomUseCase $deleteRoomUseCase;

    public function __construct(DeleteRoomUseCase $deleteRoomUseCase)
    {
        $this->deleteRoomUseCase = $deleteRoomUseCase;
    }

    public function execute(int $roomId): Response
    {
        $this->deleteRoomUseCase->execute(new DeleteRoomRequest($roomId));
        return new Response("Room has been deleted");
    }
}