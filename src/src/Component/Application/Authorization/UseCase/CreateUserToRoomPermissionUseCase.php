<?php


namespace LetEmTalk\Component\Application\Authorization\UseCase;


use LetEmTalk\Component\Application\Authorization\Request\CreateUserToRoomPermissionRequest;
use LetEmTalk\Component\Domain\Authorization\Entity\UserToRoomPermission;
use LetEmTalk\Component\Domain\Authorization\Repository\RoleRepository;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToRoomPermissionRepository;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class CreateUserToRoomPermissionUseCase
{
    private UserToRoomPermissionRepository $userToRoomPermissionRepository;
    private UserRepository $userRepository;
    private RoleRepository $roleRepository;
    private RoomRepository $roomRepository;

    public function __construct(
        UserToRoomPermissionRepository $userToRoomPermissionRepository,
        UserRepository $userRepository,
        RoomRepository $roomRepository,
        RoleRepository $roleRepository
    ) {
        $this->userToRoomPermissionRepository = $userToRoomPermissionRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->roomRepository = $roomRepository;
    }

    public function execute(CreateUserToRoomPermissionRequest $request): void
    {
        $user = $this->userRepository->getUser($request->getUserId());
        $role = $this->roleRepository->getRole($request->getRoleId());
        $room = $this->roomRepository->getRoom($request->getRoomId());
        $userToRoomPermission = new UserToRoomPermission(
            $user,
            $room,
            $role->getPermissionRoomWrite(),
            $role->getPermissionRoomManage(),
            $role
        );
        $this->userToRoomPermissionRepository->save($userToRoomPermission);
    }
}