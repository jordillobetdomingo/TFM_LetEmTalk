<?php


namespace LetEmTalk\Component\Application\Authorization\Request;


class CreateUserToRoomPermissionsRequest
{
    private int $userId;
    private int $roomId;
    private int $roleId;

    public function __construct(int $userId, int $roomId, int $roleId)
    {
        $this->userId = $userId;
        $this->roomId = $roomId;
        $this->roleId = $roleId;
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
}