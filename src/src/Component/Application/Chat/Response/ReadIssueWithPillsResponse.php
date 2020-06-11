<?php


namespace LetEmTalk\Component\Application\Chat\Response;


use LetEmTalk\Component\Domain\Authorization\Service\UserPermissions;
use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;

class ReadIssueWithPillsResponse
{
    private Issue $issue;
    private array $pills;
    private UserPermissions $userPermissions;

    public function __construct(Issue $issue, array $pills, UserPermissions $userPermissions)
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
            "canEdit" => $this->userPermissions->getEditIssue($this->issue),
            "canAddPill" => $this->userPermissions->getAddPill($this->issue)
        ];
    }

    private function getPillAsArray(Pill $pill): array
    {
        return [
            "pillId" => $pill->getId(),
            "text" => $pill->getText(),
            "authorId" => $pill->getAuthor()->getId(),
            "firstNameAuthor" => $pill->getAuthor()->getFirstName(),
            "lastNameAuthor" => $pill->getAuthor()->getLastName(),
            "createdAt" => $pill->getCreatedAt(),
            "canEdit" => $this->userPermissions->getEditPill($pill)
        ];
    }

}