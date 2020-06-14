<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\ReadRoomsRequest;
use LetEmTalk\Component\Application\Chat\UseCase\ReadRoomsUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class ReadRoomsController
{
    private ReadRoomsUseCase $readRoomsUseCase;
    private Security $security;

    public function __construct(ReadRoomsUseCase $readRoomsUseCase, Security $security)
    {
        $this->readRoomsUseCase = $readRoomsUseCase;
        $this->security = $security;
    }

    public function execute(): Response
    {
        $user = $this->security->getUser();
        if (!$user) {
            return new Response("", Response::HTTP_UNAUTHORIZED);
        }

        try {
            $roomsResponse = $this->readRoomsUseCase->execute(new ReadRoomsRequest($user->getUserId()));
            return new JsonResponse($roomsResponse->getRoomsAsArray(), Response::HTTP_OK);
        } catch (\InvalidArgumentException $argumentException) {
            return new Response("", Response::HTTP_UNAUTHORIZED);
        }
    }
}