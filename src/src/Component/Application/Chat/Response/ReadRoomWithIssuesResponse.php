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
        usort($this->issues, array($this, "compareIssueCreatedAt"));
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
            "allowCreateIssues" => $this->userPermissions->hasCreateIssuePermission($room)
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
            "createAt" => $issue->getFirstPill()->getCreateAt()->format(\DateTime::ATOM),
            "allowUpdate" => $this->userPermissions->hasUpdateIssuePermission($issue),
            "allowDelete" => $this->userPermissions->hasDeleteIssuePermission($issue)
        ];
    }

    private function compareIssueCreatedAt(Issue $a, Issue $b): int
    {
        if ($a->getFirstPill()->getCreateAt()->getTimestamp() == $b->getFirstPill()->getCreateAt()->getTimestamp()) {
            return 0;
        }
        return $a->getFirstPill()->getCreateAt()->getTimestamp() > $b->getFirstPill()->getCreateAt()->getTimestamp(
        ) ? -1 : 1;
    }

}