<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\ReadRoomsRequest;
use LetEmTalk\Component\Application\Chat\UseCase\ReadRoomsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReadRoomsController extends AbstractController
{
    private ReadRoomsUseCase $readRoomsUseCase;

    public function __construct(ReadRoomsUseCase $readRoomsUseCase)
    {
        $this->readRoomsUseCase = $readRoomsUseCase;
    }

    public function execute(): Response
    {
        $userId = $this->getUser()->getUserId();
        try {
            $roomsResponse = $this->readRoomsUseCase->execute(new ReadRoomsRequest($userId));
            return new JsonResponse($roomsResponse->getRoomsAsArray(), Response::HTTP_OK);
        } catch (\InvalidArgumentException $argumentException) {
            return new Response("", Response::HTTP_UNAUTHORIZED);
        }
    }
}