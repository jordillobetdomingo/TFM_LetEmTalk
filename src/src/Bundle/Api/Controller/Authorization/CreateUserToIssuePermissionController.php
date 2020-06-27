<?php


namespace LetEmTalk\Bundle\Api\Controller\Authorization;


use LetEmTalk\Component\Application\Authorization\Request\CreateUserToIssuePermissionRequest;
use LetEmTalk\Component\Application\Authorization\UseCase\CreateUserToIssuePermissionUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class CreateUserToIssuePermissionController
{
    const INPUT_USER_ID = "userId";
    const INPUT_ROLE_ID = "roleId";
    const INPUT_ISSUE_ID = "issueId";

    private CreateUserToIssuePermissionUseCase $createUserToIssuePermissionsUseCase;
    private Security $security;

    public function __construct(
        CreateUserToIssuePermissionUseCase $createUserToIssuePermissionsUseCase,
        Security $security
    ) {
        $this->createUserToIssuePermissionsUseCase = $createUserToIssuePermissionsUseCase;
        $this->security = $security;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $userId = $json[self::INPUT_USER_ID];
        $issueId = $json[self::INPUT_ISSUE_ID];
        $roleId = $json[self::INPUT_ISSUE_ID];

        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        $this->createUserToIssuePermissionsUseCase->execute(
            new CreateUserToIssuePermissionRequest($userId, $issueId, $roleId, $user->getUserId())
        );

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}