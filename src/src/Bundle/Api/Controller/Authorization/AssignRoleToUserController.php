<?php


namespace LetEmTalk\Bundle\Api\Controller\Authorization;

use LetEmTalk\Component\Application\Authorization\Request\AssignRoleToUserRequest;
use LetEmTalk\Component\Application\Authorization\UseCase\AssignRoleToUserUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class AssignRoleToUserController
{
    const INPUT_USER_ID = "userId";
    const INPUT_ROLE_ID = "roleId";
    const INPUT_ROOM_ID = "roomId";

    private AssignRoleToUserUseCase $assignRoleToUserUseCase;
    private Security $security;

    public function __construct(AssignRoleToUserUseCase $assignRoleToUserUseCase, Security $security)
    {
        $this->assignRoleToUserUseCase = $assignRoleToUserUseCase;
        $this->security = $security;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        if (!isset($json[self::INPUT_USER_ID]) || !isset($json[self::INPUT_ROLE_ID])) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $userId = $json[self::INPUT_USER_ID];
        $roleId = $json[self::INPUT_ROLE_ID];

        try {
            if (isset($json[self::INPUT_ROOM_ID])) {
                $this->assignRoleToUserUseCase->execute(
                    new AssignRoleToUserRequest($user->getUserId(), $userId, $roleId, $json[self::INPUT_ROOM_ID])
                );
            } else {
                $this->assignRoleToUserUseCase->execute(
                    new AssignRoleToUserRequest($user->getUserId(), $userId, $roleId)
                );
            }
            return new Response('', Response::HTTP_NO_CONTENT);
        } catch (\InvalidArgumentException $argumentException) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }
    }

}