<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\DeleteIssueRequest;
use LetEmTalk\Component\Application\Chat\UseCase\DeleteIssueUseCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteIssueController
{
    private DeleteIssueUseCase $deleteIssueUseCase;

    public function __construct(DeleteIssueUseCase $deleteIssueUseCase)
    {
        $this->deleteIssueUseCase = $deleteIssueUseCase;
    }

    public function execute(int $issueId): Response
    {
        $this->deleteIssueUseCase->execute(new DeleteIssueRequest($issueId));
        return new Response("The issue has been deleted", 204);
    }

}