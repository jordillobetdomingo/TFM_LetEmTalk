<?php


namespace LetEmTalk\Component\Application\Chat\Request;


use LetEmTalk\Component\Domain\Chat\Entity\Room;

class CreateIssueRequest
{
    private Room $room;
    private string $title;

    public function __construct(Room $room, string $title)
    {
        $this->room = $room;
        $this->title = $title;
    }

    public function getRoom(): Room
    {
        return $this->room;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}