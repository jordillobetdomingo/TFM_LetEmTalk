<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\ReadRoomWithIssuesRequest;
use LetEmTalk\Component\Application\Chat\Response\ReadRoomWithIssuesResponse;
use LetEmTalk\Component\Application\Chat\UseCase\ReadRoomWithIssuesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReadRoomWithIssuesController
{
    private ReadRoomWithIssuesUseCase $readRoomWithIssuesUseCase;

    public function __construct(ReadRoomWithIssuesUseCase $readRoomWithIssuesUseCase)
    {
        $this->readRoomWithIssuesUseCase = $readRoomWithIssuesUseCase;
    }

    public function execute(int $roomId): Response
    {
        $response = $this->readRoomWithIssuesUseCase->execute(new ReadRoomWithIssuesRequest($roomId));
        return new JsonResponse($response->getRoomWithIssuesAsArray(), 200);
    }
}