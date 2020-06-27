<?php


namespace LetEmTalk\Component\Application\Authorization\Request;


class DeleteUserToRoomPermissionRequest
{
    private int $userId;
    private int $roomId;
    private int $userIdentified;

    public function __construct(int $userId, int $roomId, int $userIdentified)
    {
        $this->userId = $userId;
        $this->roomId = $roomId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getUserIdentified(): int
    {
        return $this->userIdentified;
    }

}