<?php


namespace LetEmTalk\Component\Domain\Chat\Entity;


use LetEmTalk\Component\Domain\Chat\Entity\Room;

class Issue
{
    private int $id;
    private Room $room;
    private string $title;
    private Pill $firstPill;

}