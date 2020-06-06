<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\ReadRoomWithIssuesRequest;
use LetEmTalk\Component\Application\Chat\Response\ReadRoomWithIssuesResponse;
use LetEmTalk\Component\Application\Chat\UseCase\ReadRoomWithIssuesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class ReadRoomWithIssuesController
{
    private ReadRoomWithIssuesUseCase $readRoomWithIssuesUseCase;
    private Security $security;

    public function __construct(ReadRoomWithIssuesUseCase $readRoomWithIssuesUseCase, Security $security)
    {
        $this->readRoomWithIssuesUseCase = $readRoomWithIssuesUseCase;
        $this->security = $security;
    }

    public function execute(int $roomId): Response
    {
        $userId = $this->security->getUser()->getUserId();
        if ($userId == null) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }
        try {
            $response = $this->readRoomWithIssuesUseCase->execute(new ReadRoomWithIssuesRequest($roomId, $userId));
        } catch (\InvalidArgumentException $argumentException) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }
        return new JsonResponse($response->getRoomWithIssuesAsArray(), Response::HTTP_OK);
    }
}