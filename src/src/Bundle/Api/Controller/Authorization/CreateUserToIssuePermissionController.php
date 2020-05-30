<?php


namespace LetEmTalk\Bundle\Api\Controller\Authorization;


use LetEmTalk\Component\Application\Authorization\Request\CreateUserToIssuePermissionsRequest;
use LetEmTalk\Component\Application\Authorization\UseCase\CreateUserToIssuePermissionsUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserToIssuePermissionController
{
    private CreateUserToIssuePermissionsUseCase $createUserToIssuePermissionsUseCase;

    public function __construct(CreateUserToIssuePermissionsUseCase $createUserToIssuePermissionsUseCase)
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
            new CreateUserToIssuePermissionsRequest($userId, $issueId, $roleId)
        );

        return new Response("Permissions has been created", 204);
    }
}