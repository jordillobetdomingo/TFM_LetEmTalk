<?php


namespace LetEmTalk\Component\Domain\Chat\Entity;


use LetEmTalk\Component\Domain\User\Entity\User;

class Pill
{
    private int $id;
    private Issue $issue;
    private string $text;
    private User $author;
    private \DateTime $created;

    public function __construct(Issue $issue, string $text, User $author)
    {
        $this->issue = $issue;
        $this->text = $text;
        $this->author = $author;
        $this->created = new \DateTime("now");;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}