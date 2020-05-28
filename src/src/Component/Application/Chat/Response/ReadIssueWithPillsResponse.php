<?php


namespace LetEmTalk\Component\Application\Chat\Response;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;

class ReadIssueWithPillsResponse
{
    private Issue $issue;
    private array $pills;

    public function __construct(Issue $issue, array $pills)
    {
        $this->issue = $issue;
        $this->pills = $pills;
    }

    public function getIssueWithPillsAsArray(): array
    {
        return [
            "issue" => $this->getIssueAsArray(),
            "numberOfPills" => count($this->pills),
            "pills" => array_map(array($this, "getPillAsArray"), $this->pills)
        ];
    }

    private function getIssueAsArray(): array
    {
        return [
            "id" => $this->issue->getId(),
            "roomId" => $this->issue->getRoom()->getId(),
            "title" => $this->issue->getTitle()
        ];
    }

    private function getPillAsArray(Pill $pill): array
    {
        return [
            "pillId" => $pill->getId(),
            "text" => $pill->getText(),
            "authorId" => $pill->getAuthor()->getId(),
            "authorName" => $pill->getAuthor()->getFirstName() . " " . $pill->getAuthor()->getLastName(),
            "created" => $pill->getCreated()
        ];
    }

}