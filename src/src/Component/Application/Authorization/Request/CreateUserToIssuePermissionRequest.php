<?php


namespace LetEmTalk\Component\Application\Authorization\Request;


class CreateUserToIssuePermissionRequest
{
    private int $userId;
    private int $issueId;
    private int $roleId;
    private int $userIdentified;

    public function __construct(int $userId, int $issueId, int $roleId, int $userIdentified)
    {
        $this->userId = $userId;
        $this->issueId = $issueId;
        $this->roleId = $roleId;
        $this->userIdentified = $userIdentified;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getIssueId(): int
    {
        return $this->issueId;
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