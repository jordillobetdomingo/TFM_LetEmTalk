<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\DeleteRoomRequest;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;

class DeleteRoomUseCase
{
    private RoomRepository $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function execute(DeleteRoomRequest $request): void
    {
        $this->roomRepository->delete($request->getRoomId());
    }

}