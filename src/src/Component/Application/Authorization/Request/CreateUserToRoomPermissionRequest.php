<?php


namespace LetEmTalk\Component\Application\Authorization\Request;


class CreateUserToRoomPermissionRequest
{
    private int $userId;
    private int $roomId;
    private int $roleId;
    private int $userIdentified;

    public function __construct(int $userId, int $roomId, int $roleId, int $userIdentified)
    {
        $this->userId = $userId;
        $this->roomId = $roomId;
        $this->roleId = $roleId;
        $this->userIdentified = $userIdentified;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function getUserIdentified(): int
    {
        return $this->userIdentified;
    }
}