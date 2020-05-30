<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\ReadIssueWithPillsRequest;
use LetEmTalk\Component\Application\Chat\UseCase\ReadIssueWithPillsUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReadIssueWithPillsController
{
    private ReadIssueWithPillsUseCase $readIssueWithPillsUseCase;

    public function __construct(ReadIssueWithPillsUseCase $readIssueWithPillsUseCase)
    {
        $this->readIssueWithPillsUseCase = $readIssueWithPillsUseCase;
    }

    public function execute(int $issueId): Response
    {
        $response = $this->readIssueWithPillsUseCase->execute(new ReadIssueWithPillsRequest($issueId));
        return new JsonResponse($response->getIssueWithPillsAsArray(), 200);
    }
}