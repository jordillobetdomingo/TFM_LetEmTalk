<?php


namespace LetEmTalk\Component\Application\Chat\Request;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\User\Entity\User;

class CreatePillRequest
{
    private int $issueId;
    private string $text;
    private int $authorId;

    public function __construct(int $issueId, string $text, int $authorId)
    {
        $this->issueId = $issueId;
        $this->text = $text;
        $this->authorId = $authorId;
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

}