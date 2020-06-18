<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\ReadRoomsRequest;
use LetEmTalk\Component\Application\Chat\Response\ReadRoomsResponse;
use LetEmTalk\Component\Domain\Authorization\Service\AdminAuthorization;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;

class ReadRoomsUseCase
{
    private UserAuthorization $userAuthorization;
    private AdminAuthorization $adminAuthorization;
    private RoomRepository $roomRepository;

    public function __construct(
        UserAuthorization $userAuthorization,
        AdminAuthorization $adminAuthorization,
        RoomRepository $roomRepository
    ) {
        $this->userAuthorization = $userAuthorization;
        $this->adminAuthorization = $adminAuthorization;
        $this->roomRepository = $roomRepository;
    }

    public function execute(ReadRoomsRequest $request): ReadRoomsResponse
    {
        if ($this->adminAuthorization->isAdmin($request->getUserId())) {
            $rooms = $this->roomRepository->getAllRooms();
        } else {
            $rooms = $this->userAuthorization->getRoomsByUser($request->getUserId());
            if ($rooms === null) {
                throw new \InvalidArgumentException();
            }
        }
        return new ReadRoomsResponse($rooms);
    }
}