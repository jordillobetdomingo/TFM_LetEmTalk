<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\DeleteIssueRequest;
use LetEmTalk\Component\Application\Chat\UseCase\DeleteIssueUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class DeleteIssueController
{
    private DeleteIssueUseCase $deleteIssueUseCase;
    private Security $security;

    public function __construct(DeleteIssueUseCase $deleteIssueUseCase, Security $security)
    {
        $this->deleteIssueUseCase = $deleteIssueUseCase;
        $this->security = $security;
    }

    public function execute(int $issueId): Response
    {
        try {
            $this->deleteIssueUseCase->execute(
                new DeleteIssueRequest($issueId, $this->security->getUser()->getUserId())
            );
        } catch (\InvalidArgumentException $argumentException) {
            return new Response("", Response::HTTP_UNAUTHORIZED);
        }
        return new Response("The issue has been deleted", 204);
    }

}