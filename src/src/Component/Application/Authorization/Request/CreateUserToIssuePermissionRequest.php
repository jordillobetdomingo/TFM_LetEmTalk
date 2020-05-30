<?php


namespace LetEmTalk\Component\Application\Authorization\Request;


class CreateUserToIssuePermissionRequest
{
    private int $userId;
    private int $issueId;
    private int $roleId;

    public function __construct(int $userId, int $issueId, int $roleId)
    {
        $this->userId = $userId;
        $this->issueId = $issueId;
        $this->roleId = $roleId;
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

}