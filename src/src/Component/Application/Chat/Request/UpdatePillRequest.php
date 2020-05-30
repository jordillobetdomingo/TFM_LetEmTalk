<?php


namespace LetEmTalk\Component\Application\Chat\Request;


class UpdatePillRequest
{
    private int $pillId;
    private string $text;

    public function __construct(int $pillId, string $text)
    {
        $this->pillId = $pillId;
        $this->text = $text;
    }

    public function getPillId(): int
    {
        return $this->pillId;
    }

    public function getText(): string
    {
        return $this->text;
    }
}