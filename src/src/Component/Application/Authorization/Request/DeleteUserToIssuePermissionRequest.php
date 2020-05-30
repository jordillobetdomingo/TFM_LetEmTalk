<?php


namespace LetEmTalk\Component\Application\Authorization\Request;


class DeleteUserToIssuePermissionRequest
{
    private int $userId;
    private int $issueId;

    public function __construct(int $userId, int $issueId)
    {
        $this->userId = $userId;
        $this->issueId = $issueId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getIssueId()
    {
        return $this->issueId;
    }
}