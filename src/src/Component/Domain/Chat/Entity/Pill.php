<?php


namespace LetEmTalk\Component\Domain\Chat\Entity;


use LetEmTalk\Component\Domain\User\Entity\User;

class Pill
{
    private int $id;
    private Issue $issue;
    private string $text;
    private User $author;
    private \DateTime $createAt;
    private \DateTime $updateAt;

    public function __construct(Issue $issue, string $text, User $author)
    {
        $this->issue = $issue;
        $this->text = $text;
        $this->author = $author;
        $this->createAt = new \DateTime("now");
        $this->updateAt = new \DateTime("now");
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIssue(): Issue
    {
        return $this->issue;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
        $this->updateAt = new \DateTime("now");
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function getCreateAt(): \DateTime
    {
        return $this->createAt;
    }
}