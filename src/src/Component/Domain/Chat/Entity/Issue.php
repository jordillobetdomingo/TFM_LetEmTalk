<?php


namespace LetEmTalk\Component\Domain\Chat\Entity;


class Issue
{
    private int $id;
    private Room $room;
    private string $title;
    private Pill $firstPill;
    private \DateTime $createAt;
    private \DateTime $updateAt;

    public function __construct(Room $room, string $title)
    {
        $this->room = $room;
        $this->title = $title;
        $this->createAt = new \DateTime("now");
        $this->updateAt = new \DateTime("now");
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRoom(): Room
    {
        return $this->room;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
        $this->updateAt = new \DateTime("now");
    }

    public function getFirstPill(): Pill
    {
        return $this->firstPill;
    }

    public function setFirstPill(Pill $pill): void
    {
        $this->firstPill = $pill;
        $this->updateAt = new \DateTime("now");
    }
}