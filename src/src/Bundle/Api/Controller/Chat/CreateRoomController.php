<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\CreateRoomRequest;
use LetEmTalk\Component\Application\Chat\UseCase\CreateRoomUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class CreateRoomController
{
    const INPUT_USER_ID = 'userId';

    private CreateRoomUseCase $createRoomUseCase;
    private Security $security;

    public function __construct(CreateRoomUseCase $createRoomUseCase, Security $security)
    {
        $this->createRoomUseCase = $createRoomUseCase;
        $this->security = $security;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $userId = $json[self::INPUT_USER_ID];

        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        $this->createRoomUseCase->execute(new CreateRoomRequest($userId, $user->getUserId()));

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}