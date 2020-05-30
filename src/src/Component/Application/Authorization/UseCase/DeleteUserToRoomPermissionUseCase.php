<?php


namespace LetEmTalk\Component\Application\Authorization\UseCase;


use LetEmTalk\Component\Application\Authorization\Request\DeleteUserToRoomPermissionRequest;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToRoomPermissionRepository;

class DeleteUserToRoomPermissionUseCase
{
    private UserToRoomPermissionRepository $userToRoomPermissionRepository;

    public function __construct(UserToRoomPermissionRepository $userToRoomPermissionRepository)
    {
        $this->userToRoomPermissionRepository = $userToRoomPermissionRepository;
    }

    public function execute(DeleteUserToRoomPermissionRequest $request): void
    {
        $this->userToRoomPermissionRepository->delete($request->getUserId(), $request->getRoomId());
    }
}