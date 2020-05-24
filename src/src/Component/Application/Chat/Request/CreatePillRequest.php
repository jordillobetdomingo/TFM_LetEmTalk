<?php


namespace LetEmTalk\Component\Application\Chat\Request;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\User\Entity\User;

class CreatePillRequest
{
    private Issue $issue;
    private string $text;
    private User $author;

    public function __construct(Issue $issue, string $text, User $author)
    {
        $this->issue = $issue;
        $this->text = $text;
        $this->author = $author;
    }

    public function getIssue(): Issue
    {
        return $this->issue;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

}