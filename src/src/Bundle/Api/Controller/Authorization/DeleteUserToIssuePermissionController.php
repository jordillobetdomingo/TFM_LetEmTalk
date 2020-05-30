<?php


namespace LetEmTalk\Bundle\Api\Controller\Authorization;


use LetEmTalk\Component\Application\Authorization\Request\DeleteUserToIssuePermissionRequest;
use LetEmTalk\Component\Application\Authorization\UseCase\DeleteUserToIssuePermissionUseCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserToIssuePermissionController
{
    private DeleteUserToIssuePermissionUseCase $deleteUserToIssuePermissionUseCase;

    public function __construct(DeleteUserToIssuePermissionUseCase $deleteUserToIssuePermissionUseCase)
    {
        $this->deleteUserToIssuePermissionUseCase = $deleteUserToIssuePermissionUseCase;
    }

    public function execute(int $userId, int $issueId): Response
    {
        $this->deleteUserToIssuePermissionUseCase->execute(new DeleteUserToIssuePermissionRequest($userId, $issueId));
        return new Response("UserToIssuePermission has been deleted", 204);
    }

}