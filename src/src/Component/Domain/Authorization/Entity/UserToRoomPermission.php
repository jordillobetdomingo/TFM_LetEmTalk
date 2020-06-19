<?php


namespace LetEmTalk\Component\Domain\Authorization\Entity;


use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\User\Entity\User;

class UserToRoomPermission
{
    private User $user;
    private Room $room;
    private bool $writePermission;
    private bool $managePermission;
    private Role $role;

    public function __construct(User $user, Room $room, bool $writePermission, bool $managePermission, Role $role)
    {
        $this->user = $user;
        $this->room = $room;
        $this->writePermission = $writePermission;
        $this->managePermission = $managePermission;
        $this->role = $role;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getRoom(): Room
    {
        return $this->room;
    }

    public function hasRoomWritePermission(): bool
    {
        return $this->writePermission;
    }

    public function hasRoomManagePermission(): bool
    {
        return $this->managePermission;
    }

    public function getRole(): Role
    {
        return $this->role;
    }
}