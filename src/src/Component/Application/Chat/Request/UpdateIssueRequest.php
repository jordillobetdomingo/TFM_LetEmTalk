<?php


namespace LetEmTalk\Component\Application\Chat\Request;


class UpdateIssueRequest
{
    private int $issueId;
    private string $title;
    private int $userId;

    public function __construct(int $issueId, string $title, $userId)
    {
        $this->issueId = $issueId;
        $this->title = $title;
        $this->userId = $userId;
    }

    public function getIssueId(): int
    {
        return $this->issueId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}