<?php


namespace LetEmTalk\Component\Application\Chat\Request;


class CreateIssueRequest
{
    private int $roomId;
    private string $title;
    private string $text;
    private int $authorId;

    public function __construct(int $roomId, string $title, string $text, int $authorId)
    {
        $this->roomId = $roomId;
        $this->title = $title;
        $this->text = $text;
        $this->authorId = $authorId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getTitle(): string
    {
        return $this->title;
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