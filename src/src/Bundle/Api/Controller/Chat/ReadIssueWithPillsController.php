<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\ReadIssueWithPillsRequest;
use LetEmTalk\Component\Application\Chat\UseCase\ReadIssueWithPillsUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class ReadIssueWithPillsController
{
    private ReadIssueWithPillsUseCase $readIssueWithPillsUseCase;
    private Security $security;

    public function __construct(
        ReadIssueWithPillsUseCase $readIssueWithPillsUseCase,
        Security $security
    ) {
        $this->readIssueWithPillsUseCase = $readIssueWithPillsUseCase;
        $this->security = $security;
    }

    public function execute(int $issueId): Response
    {
        $userId = $this->security->getUser()->getUserId();
        try {
            $response = $this->readIssueWithPillsUseCase->execute(new ReadIssueWithPillsRequest($issueId, $userId));
        } catch (\InvalidArgumentException $argumentException) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }
        return new JsonResponse($response->getIssueWithPillsAsArray(), Response::HTTP_OK);
    }
}