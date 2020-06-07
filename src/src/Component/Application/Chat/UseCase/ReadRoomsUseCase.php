<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\ReadRoomsRequest;
use LetEmTalk\Component\Application\Chat\Response\ReadRoomsResponse;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;

class ReadRoomsUseCase
{
    private UserAuthorization $userAuthorization;

    public function __construct(UserAuthorization $userAuthorization)
    {
        $this->userAuthorization = $userAuthorization;
    }

    public function execute(ReadRoomsRequest $request): ReadRoomsResponse
    {
        $rooms = $this->userAuthorization->getRoomsByUser($request->getUserId());
        if ($rooms == null) {
            throw new \InvalidArgumentException();
        }
        return new ReadRoomsResponse($rooms);
    }
}