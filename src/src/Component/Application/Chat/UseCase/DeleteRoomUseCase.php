<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\DeleteRoomRequest;
use LetEmTalk\Component\Domain\Authorization\Service\AdminAuthorization;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;

class DeleteRoomUseCase
{
    private RoomRepository $roomRepository;
    private AdminAuthorization $adminAuthorization;

    public function __construct(RoomRepository $roomRepository, AdminAuthorization $adminAuthorization)
    {
        $this->roomRepository = $roomRepository;
        $this->adminAuthorization = $adminAuthorization;
    }

    public function execute(DeleteRoomRequest $request): void
    {
        if (!$this->adminAuthorization->isAdmin($request->getUserId())) {
            throw new \InvalidArgumentException();
        }

        $this->roomRepository->delete($request->getRoomId());
    }

}