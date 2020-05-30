<?php


namespace LetEmTalk\Bundle\Api\Controller\Authorization;


use LetEmTalk\Component\Application\Authorization\Request\CreateUserToIssuePermissionRequest;
use LetEmTalk\Component\Application\Authorization\UseCase\CreateUserToIssuePermissionUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserToIssuePermissionController
{
    private CreateUserToIssuePermissionUseCase $createUserToIssuePermissionsUseCase;

    public function __construct(CreateUserToIssuePermissionUseCase $createUserToIssuePermissionsUseCase)
    {
        $this->createUserToIssuePermissionsUseCase = $createUserToIssuePermissionsUseCase;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $userId = $json["userId"];
        $issueId = $json["issueId"];
        $roleId = $json["roleId"];

        $this->createUserToIssuePermissionsUseCase->execute(
            new CreateUserToIssuePermissionRequest($userId, $issueId, $roleId)
        );

        return new Response("Permissions has been created", 204);
    }
}