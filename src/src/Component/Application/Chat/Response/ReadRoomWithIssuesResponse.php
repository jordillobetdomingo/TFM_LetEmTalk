<?php


namespace LetEmTalk\Component\Application\Chat\Response;


use LetEmTalk\Component\Domain\Authorization\Service\UserPermission;
use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Room;

class ReadRoomWithIssuesResponse
{
    private Room $room;
    private array $issues;
    private UserPermission $userPermissions;

    public function __construct(Room $room, array $issues, UserPermission $userPermissions)
    {
        $this->room = $room;
        $this->issues = $issues;
        $this->userPermissions = $userPermissions;
    }

    public function getRoomWithIssuesAsArray(): array
    {
        return [
            "room" => $this->getRoomAsArray($this->room),
            "numberOfIssues" => count($this->issues),
            "issues" => array_map(array($this, "getIssueAsArray"), $this->issues)
        ];
    }

    private function getRoomAsArray(Room $room): array
    {
        return [
            "id" => $room->getId(),
            "userId" => $room->getUser()->getId(),
            "firstName" => $room->getUser()->getFirstName(),
            "lastName" => $room->getUser()->getLastName(),
            "allowCreateIssues" => $this->userPermissions->allowCreateIssue($room)
        ];
    }

    private function getIssueAsArray(Issue $issue): array
    {
        return [
            "issueId" => $issue->getId(),
            "title" => $issue->getTitle(),
            "text" => $issue->getFirstPill()->getText(),
            "authorId" => $issue->getFirstPill()->getAuthor()->getId(),
            "firstNameAuthor" => $issue->getFirstPill()->getAuthor()->getFirstName(),
            "lastNameAuthor" => $issue->getFirstPill()->getAuthor()->getLastName(),
            "createAt" => $issue->getFirstPill()->getCreatedAt(),
            "allowUpdate" => $this->userPermissions->allowUpdateIssue($issue),
            "allowDelete" => $this->userPermissions->allowDeleteIssue($issue)
        ];
    }

}