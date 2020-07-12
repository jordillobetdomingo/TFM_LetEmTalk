<?php


namespace LetEmTalk\Bundle\Api\Controller\Authorization;


use LetEmTalk\Component\Application\Authorization\Request\CreateUserToRoomPermissionRequest;
use LetEmTalk\Component\Application\Authorization\UseCase\CreateUserToRoomPermissionUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class CreateUserToRoomPermissionController
{
    const INPUT_USER_ID = 'userId';
    const INPUT_ROLE_ID = 'roleId';
    const INPUT_ROOM_ID = 'roomId';

    private CreateUserToRoomPermissionUseCase $createUserToRoomPermissionsUseCase;
    private Security $security;

    public function __construct(CreateUserToRoomPermissionUseCase $createUserToRoomPermissionsUseCase, Security $security)
    {
        $this->createUserToRoomPermissionsUseCase = $createUserToRoomPermissionsUseCase;
        $this->security = $security;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $userId = $json[self::INPUT_USER_ID];
        $roomId = $json[self::INPUT_ROOM_ID];
        $roleId = $json[self::INPUT_ROLE_ID];

        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        $this->createUserToRoomPermissionsUseCase->execute(
            new CreateUserToRoomPermissionRequest($userId, $roomId, $roleId, $user->getUserId())
        );

        return new Response('', Response::HTTP_NO_CONTENT);
    }

}