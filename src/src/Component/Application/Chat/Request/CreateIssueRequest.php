<?php


namespace LetEmTalk\Component\Application\Chat\Request;


class CreateIssueRequest
{
    private int $roomId;
    private string $title;
    private string $text;
    private int $authorId;
    private int $userId;

    public function __construct(int $roomId, string $title, string $text, int $authorId, int $userId)
    {
        $this->roomId = $roomId;
        $this->title = $title;
        $this->text = $text;
        $this->authorId = $authorId;
        $this->userId = $userId;
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

    public function getUserId(): int
    {
        return $this->userId;
    }
}