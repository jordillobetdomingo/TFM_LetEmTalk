<?php


namespace LetEmTalk\Component\Domain\Chat\Entity;


use LetEmTalk\Component\Domain\Entity\Chat\Room;

class Issue
{
    private int $id;
    private Room $room;
    private string $title;

}