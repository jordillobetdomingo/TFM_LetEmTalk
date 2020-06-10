<?php


namespace LetEmTalk\Component\Application\Chat\Response;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Room;

class ReadRoomWithIssuesResponse
{
    private Room $room;
    private array $issues;

    public function __construct(Room $room, array $issues)
    {
        $this->room = $room;
        $this->issues = $issues;
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
            "roomId" => $room->getId(),
            "userId" => $room->getUser()->getId(),
            "firstName" => $room->getUser()->getFirstName(),
            "lastName" => $room->getUser()->getLastName()
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
            "createdAt" => $issue->getFirstPill()->getCreated()
        ];
    }

}