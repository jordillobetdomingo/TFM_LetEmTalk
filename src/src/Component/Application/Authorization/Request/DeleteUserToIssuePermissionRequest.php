<?php


namespace LetEmTalk\Component\Application\Authorization\Request;


class DeleteUserToIssuePermissionRequest
{
    private int $userId;
    private int $issueId;
    private int $userIdentified;

    public function __construct(int $userId, int $issueId, int $userIdentified)
    {
        $this->userId = $userId;
        $this->issueId = $issueId;
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

    public function getUserIdentified(): int
    {
        return $this->userIdentified;
    }
}