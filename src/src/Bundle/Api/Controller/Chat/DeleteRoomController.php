<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\DeleteRoomRequest;
use LetEmTalk\Component\Application\Chat\UseCase\DeleteRoomUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class DeleteRoomController
{
    private DeleteRoomUseCase $deleteRoomUseCase;
    private Security $security;

    public function __construct(DeleteRoomUseCase $deleteRoomUseCase, Security $security)
    {
        $this->deleteRoomUseCase = $deleteRoomUseCase;
        $this->security = $security;
    }

    public function execute(int $roomId): Response
    {
        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }
        $this->deleteRoomUseCase->execute(new DeleteRoomRequest($roomId, $user->getUserId()));
        return new Response('', Response::HTTP_NO_CONTENT);
    }
}