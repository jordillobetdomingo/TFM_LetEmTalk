<?php


namespace LetEmTalk\Component\Domain\Chat\Entity;


use LetEmTalk\Component\Domain\Chat\Entity\Room;

class Issue
{
    private int $id;
    private Room $room;
    private string $title;
    private Pill $firstPill;

    public function __construct(Room $room, string $title)
    {
        $this->room = $room;
        $this->title = $title;
    }

    public function setFirstPill(Pill $pill)
    {
        $this->firstPill = $pill;
    }

    public function getId(): int
    {
        return $this->id;
    }
}