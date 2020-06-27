<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\CreateRoomRequest;
use LetEmTalk\Component\Domain\Authorization\Service\AdminAuthorization;
use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class CreateRoomUseCase
{
    private RoomRepository $roomRepository;
    private UserRepository $userRepository;
    private AdminAuthorization $adminAuthorization;

    public function __construct(RoomRepository $roomRepository, UserRepository $userRepository, AdminAuthorization $adminAuthorization)
    {
        $this->roomRepository = $roomRepository;
        $this->userRepository = $userRepository;
        $this->adminAuthorization = $adminAuthorization;
    }

    public function execute(CreateRoomRequest $request): void
    {
        if (!$this->$this->adminAuthorization->isAdmin($request->getUserIdentified())) {
            throw new \InvalidArgumentException();
        }

        $room = new Room($this->userRepository->getUser($request->getUserId()));
        $this->roomRepository->save($room);
    }
}