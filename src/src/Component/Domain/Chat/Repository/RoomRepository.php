<?php


namespace LetEmTalk\Component\Domain\Chat\Repository;


use LetEmTalk\Component\Domain\Chat\Entity\Room;

interface RoomRepository
{
    public function save(Room $room): void;
}