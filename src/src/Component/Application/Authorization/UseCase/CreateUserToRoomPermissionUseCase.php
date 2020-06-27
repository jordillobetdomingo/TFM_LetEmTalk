<?php


namespace LetEmTalk\Component\Application\Authorization\UseCase;


use LetEmTalk\Component\Application\Authorization\Request\CreateUserToRoomPermissionRequest;
use LetEmTalk\Component\Domain\Authorization\Entity\UserToRoomPermission;
use LetEmTalk\Component\Domain\Authorization\Repository\RoleRepository;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToRoomPermissionRepository;
use LetEmTalk\Component\Domain\Authorization\Service\AdminAuthorization;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class CreateUserToRoomPermissionUseCase
{
    private UserToRoomPermissionRepository $userToRoomPermissionRepository;
    private UserRepository $userRepository;
    private RoleRepository $roleRepository;
    private RoomRepository $roomRepository;
    private AdminAuthorization $adminAuthorization;

    public function __construct(
        UserToRoomPermissionRepository $userToRoomPermissionRepository,
        UserRepository $userRepository,
        RoomRepository $roomRepository,
        RoleRepository $roleRepository,
        AdminAuthorization $adminAuthorization
    ) {
        $this->userToRoomPermissionRepository = $userToRoomPermissionRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->roomRepository = $roomRepository;
        $this->adminAuthorization = $adminAuthorization;
    }

    public function execute(CreateUserToRoomPermissionRequest $request): void
    {
        if (!$this->adminAuthorization->isAdmin($request->getUserIdentified())) {
            throw new \InvalidArgumentException();
        }

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