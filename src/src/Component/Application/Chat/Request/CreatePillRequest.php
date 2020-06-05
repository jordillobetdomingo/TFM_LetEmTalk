<?php


namespace LetEmTalk\Component\Application\Chat\Request;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\User\Entity\User;

class CreatePillRequest
{
    private int $issueId;
    private string $text;
    private int $authorId;
    private int $userId;

    public function __construct(int $issueId, string $text, int $authorId, int $userId)
    {
        $this->issueId = $issueId;
        $this->text = $text;
        $this->authorId = $authorId;
        $this->userId = $userId;
    }

    public function getIssueId(): int
    {
        return $this->issueId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

}