<?php


namespace LetEmTalk\Component\Application\Chat\Request;


class UpdateIssueRequest
{
    private int $issueId;
    private string $title;
    private ?string $textFirstPill;

    public function __construct(int $issueId, string $title, ?string $textFirstPill = null)
    {
        $this->issueId = $issueId;
        $this->title = $title;
        $this->textFirstPill = $textFirstPill;
    }

    public function getIssueId(): int
    {
        return $this->issueId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getTextFirstPill(): ?string
    {
        return $this->textFirstPill;
    }

}