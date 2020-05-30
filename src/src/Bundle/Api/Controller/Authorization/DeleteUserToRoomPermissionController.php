<?php


namespace LetEmTalk\Bundle\Api\Controller\Authorization;


use LetEmTalk\Component\Application\Authorization\Request\DeleteUserToRoomPermissionRequest;
use LetEmTalk\Component\Application\Authorization\UseCase\DeleteUserToRoomPermissionUseCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserToRoomPermissionController
{
    private DeleteUserToRoomPermissionUseCase $deleteUserToRoomPermissionUseCase;

    public function __construct(DeleteUserToRoomPermissionUseCase $deleteUserToRoomPermissionUseCase)
    {
        $this->deleteUserToRoomPermissionUseCase = $deleteUserToRoomPermissionUseCase;
    }

    public function execute(int $userId, int $roomId): Response
    {
        $this->deleteUserToRoomPermissionUseCase->execute(new DeleteUserToRoomPermissionRequest($userId, $roomId));

        return new Response("UserToRoomPermission has been removed", 204);
    }

}