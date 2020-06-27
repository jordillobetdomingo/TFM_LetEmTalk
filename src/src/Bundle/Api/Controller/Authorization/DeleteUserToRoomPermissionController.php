<?php


namespace LetEmTalk\Bundle\Api\Controller\Authorization;


use LetEmTalk\Component\Application\Authorization\Request\DeleteUserToRoomPermissionRequest;
use LetEmTalk\Component\Application\Authorization\UseCase\DeleteUserToRoomPermissionUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class DeleteUserToRoomPermissionController
{
    private DeleteUserToRoomPermissionUseCase $deleteUserToRoomPermissionUseCase;
    private Security $security;

    public function __construct(
        DeleteUserToRoomPermissionUseCase $deleteUserToRoomPermissionUseCase,
        Security $security
    ) {
        $this->deleteUserToRoomPermissionUseCase = $deleteUserToRoomPermissionUseCase;
        $this->security = $security;
    }

    public function execute(int $userId, int $roomId): Response
    {
        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        $this->deleteUserToRoomPermissionUseCase->execute(
            new DeleteUserToRoomPermissionRequest($userId, $roomId, $user->getUserId())
        );

        return new Response('', Response::HTTP_UNAUTHORIZED);
    }

}