<?php


namespace LetEmTalk\Component\Application\Authorization\Request;


class AssignRoleToUserRequest
{
    private int $userIdentified;
    private int $userId;
    private int $roleId;
    private ?int $roomId;

    public function __construct(int $userIdentified, int $userId, int $roleId, ?int $roomId = null) {
        $this->userIdentified = $userIdentified;
        $this->userId = $userId;
        $this->roleId = $roleId;
        $this->roomId = $roomId;
    }

    public function getUserIdentified(): int
    {
        return $this->userIdentified;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function getRoomId(): ?int
    {
        return $this->roomId;
    }

}