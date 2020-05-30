<?php


namespace LetEmTalk\Bundle\Api\Controller\Authorization;


use LetEmTalk\Component\Application\Authorization\Request\CreateUserToRoomPermissionsRequest;
use LetEmTalk\Component\Application\Authorization\UseCase\CreateUserToRoomPermissionsUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserToRoomPermissionController
{
    private CreateUserToRoomPermissionsUseCase $createUserToRoomPermissionsUseCase;

    public function __construct(CreateUserToRoomPermissionsUseCase $createUserToRoomPermissionsUseCase)
    {
        $this->createUserToRoomPermissionsUseCase = $createUserToRoomPermissionsUseCase;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $userId = $json["userId"];
        $roomId = $json["roomId"];
        $roleId = $json["roleId"];

        $this->createUserToRoomPermissionsUseCase->execute(
            new CreateUserToRoomPermissionsRequest($userId, $roomId, $roleId)
        );

        return new Response("Permissions has been created", 204);
    }

}