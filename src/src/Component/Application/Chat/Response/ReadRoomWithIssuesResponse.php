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
            "userName" => $room->getUser()->getFirstName() . " " . $room->getUser()->getLastName()
        ];
    }

    private function getIssueAsArray(Issue $issue): array
    {
        return [
            "issueId" => $issue->getId(),
            "title" => $issue->getTitle(),
            "userId" => $issue->getFirstPill()->getAuthor()->getId(),
            "userName" => $issue->getFirstPill()->getAuthor()->getFirstName(),
            "created" => $issue->getFirstPill()->getCreated()
        ];
    }

}