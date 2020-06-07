<?php


namespace LetEmTalk\Component\Domain\Authorization\Entity;


use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\User\Entity\User;

class UserToRoomPermission
{
    private User $user;
    private Room $room;
    private bool $permissionWrite;
    private bool $permissionManage;

    public function __construct(User $user, Room $room, Role $role)
    {
        $this->user = $user;
        $this->room = $room;
        $this->permissionWrite = $role->getPermissionRoomWrite();
        $this->permissionManage = $role->getPermissionRoomManage();
    }

    public function getRoom(): Room
    {
        return $this->room;
    }

    public function hasRoomWritePermission(): bool
    {
        return $this->permissionWrite;
    }

    public function hasRoomManagePermission(): bool
    {
        return $this->permissionManage;
    }
}