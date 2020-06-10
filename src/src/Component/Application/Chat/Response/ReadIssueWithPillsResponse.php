<?php


namespace LetEmTalk\Component\Application\Chat\Response;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;

class ReadIssueWithPillsResponse
{
    private Issue $issue;
    private array $pills;
    private array $issuePermissions;

    public function __construct(Issue $issue, array $pills, array $issuePermissions)
    {
        $this->issue = $issue;
        $this->pills = $pills;
        $this->issuePermissions = $issuePermissions;
    }

    public function getIssueWithPillsAsArray(): array
    {
        return [
            "issue" => $this->getIssueAsArray(),
            "numberOfPills" => count($this->pills),
            "pills" => array_map(array($this, "getPillAsArray"), $this->pills),
            "permissions" => $this->issuePermissions
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
            "firstNameAuthor" => $pill->getAuthor()->getFirstName(),
            "lastNameAuthor". " " . $pill->getAuthor()->getLastName(),
            "created" => $pill->getCreated()
        ];
    }

}