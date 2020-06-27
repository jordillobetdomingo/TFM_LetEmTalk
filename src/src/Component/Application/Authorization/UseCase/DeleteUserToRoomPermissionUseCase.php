<?php


namespace LetEmTalk\Component\Application\Authorization\UseCase;


use LetEmTalk\Component\Application\Authorization\Request\DeleteUserToRoomPermissionRequest;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToRoomPermissionRepository;
use LetEmTalk\Component\Domain\Authorization\Service\AdminAuthorization;

class DeleteUserToRoomPermissionUseCase
{
    private UserToRoomPermissionRepository $userToRoomPermissionRepository;
    private AdminAuthorization $adminAuthorization;

    public function __construct(
        UserToRoomPermissionRepository $userToRoomPermissionRepository,
        AdminAuthorization $adminAuthorization
    ) {
        $this->userToRoomPermissionRepository = $userToRoomPermissionRepository;
        $this->adminAuthorization = $adminAuthorization;
    }

    public function execute(DeleteUserToRoomPermissionRequest $request): void
    {
        if (!$this->adminAuthorization->isAdmin($request->getUserIdentified())) {
            throw new \InvalidArgumentException();
        }

        $this->userToRoomPermissionRepository->delete($request->getUserId(), $request->getRoomId());
    }
}