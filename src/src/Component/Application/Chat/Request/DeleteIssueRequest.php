<?php


namespace LetEmTalk\Component\Application\Chat\Request;


class DeleteIssueRequest
{
    private int $issueId;
    private int $userId;

    public function __construct(int $issueId, int $userId)
    {
        $this->issueId = $issueId;
        $this->userId = $userId;
    }

    public function getIssueId(): int
    {
        return $this->issueId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}