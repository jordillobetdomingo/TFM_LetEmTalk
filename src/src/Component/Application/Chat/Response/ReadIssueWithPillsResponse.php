<?php


namespace LetEmTalk\Component\Application\Chat\Response;


use LetEmTalk\Component\Domain\Authorization\Service\UserPermission;
use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;

class ReadIssueWithPillsResponse
{
    private Issue $issue;
    private array $pills;
    private UserPermission $userPermissions;

    public function __construct(Issue $issue, array $pills, UserPermission $userPermissions)
    {
        $this->issue = $issue;
        $this->pills = $pills;
        $this->userPermissions = $userPermissions;
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
            "title" => $this->issue->getTitle(),
            "allowUpdate" => $this->userPermissions->allowUpdateIssue($this->issue),
            "allowDelete" => $this->userPermissions->allowDeleteIssue($this->issue),
            "allowCreatePills" => $this->userPermissions->allowCreatePill($this->issue)
        ];
    }

    private function getPillAsArray(Pill $pill): array
    {
        return [
            "id" => $pill->getId(),
            "text" => $pill->getText(),
            "authorId" => $pill->getAuthor()->getId(),
            "firstNameAuthor" => $pill->getAuthor()->getFirstName(),
            "lastNameAuthor" => $pill->getAuthor()->getLastName(),
            "createAt" => $pill->getCreateAt(),
            "allowUpdate" => $this->userPermissions->allowUpdatePill($pill),
            "allowDelete" => $this->userPermissions->allowDeletePill($pill)
        ];
    }

}