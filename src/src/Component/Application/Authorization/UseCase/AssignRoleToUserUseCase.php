<?php


namespace LetEmTalk\Component\Application\Authorization\UseCase;


use LetEmTalk\Component\Application\Authorization\Request\AssignRoleToUserRequest;
use LetEmTalk\Component\Domain\Authorization\Entity\UserToRoomPermission;
use LetEmTalk\Component\Domain\Authorization\Repository\RoleRepository;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToRoomPermissionRepository;
use LetEmTalk\Component\Domain\Authorization\Service\AdminAuthorization;
use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class AssignRoleToUserUseCase
{
    private RoomRepository $roomRepository;
    private RoleRepository $roleRepository;
    private UserRepository $userRepository;
    private UserToRoomPermissionRepository $userToRoomPermissionRepository;
    private AdminAuthorization $adminAuthorization;

    public function __construct(
        RoomRepository $roomRepository,
        RoleRepository $roleRepository,
        UserRepository $userRepository,
        UserToRoomPermissionRepository $userToRoomPermissionRepository,
        AdminAuthorization $adminAuthorization
    ) {
        $this->roomRepository = $roomRepository;
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->userToRoomPermissionRepository = $userToRoomPermissionRepository;
        $this->adminAuthorization = $adminAuthorization;
    }

    public function execute(AssignRoleToUserRequest $request): void
    {
        if (!$this->adminAuthorization->isAdmin($request->getUserIdentified())) {
            throw new \InvalidArgumentException();
        }

        $role = $this->roleRepository->getRole($request->getRoleId());
        $user = $this->userRepository->getUser($request->getUserId());
        if ($role->getCreateRoom()) {
            $room = new Room($user);
            $this->roomRepository->save($room);
        } else {
            if ($request->getRoomId() == null) {
                throw new \InvalidArgumentException();
            }
            $room = $this->roomRepository->getRoom($request->getRoomId());
        }
        $userToRoomPermission = new UserToRoomPermission(
            $user,
            $room,
            $role->getPermissionIssueWrite(),
            $role->getPermissionIssueWrite()
        );
        $this->userToRoomPermissionRepository->save($userToRoomPermission);
    }

}