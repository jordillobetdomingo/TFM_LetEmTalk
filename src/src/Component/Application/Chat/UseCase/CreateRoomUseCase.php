<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\CreateRoomRequest;
use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class CreateRoomUseCase
{
    private RoomRepository $roomRepository;
    private UserRepository $userRepository;

    public function __construct(RoomRepository $roomRepository, UserRepository $userRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->userRepository = $userRepository;
    }

    public function execute(CreateRoomRequest $request): void
    {
        $room = new Room($this->userRepository->getUser($request->getUserId()));
        $this->roomRepository->save($room);
    }
}