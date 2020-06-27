<?php


namespace LetEmTalk\Bundle\Api\Controller\Authorization;


use LetEmTalk\Component\Application\Authorization\Request\DeleteUserToIssuePermissionRequest;
use LetEmTalk\Component\Application\Authorization\UseCase\DeleteUserToIssuePermissionUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class DeleteUserToIssuePermissionController
{
    private DeleteUserToIssuePermissionUseCase $deleteUserToIssuePermissionUseCase;
    private Security $security;

    public function __construct(
        DeleteUserToIssuePermissionUseCase $deleteUserToIssuePermissionUseCase,
        Security $security
    ) {
        $this->deleteUserToIssuePermissionUseCase = $deleteUserToIssuePermissionUseCase;
        $this->security = $security;
    }

    public function execute(int $userId, int $issueId): Response
    {
        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }
        $this->deleteUserToIssuePermissionUseCase->execute(
            new DeleteUserToIssuePermissionRequest($userId, $issueId, $user->getUserId())
        );
        return new Response('', Response::HTTP_NO_CONTENT);
    }

}