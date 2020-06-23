<?php


namespace LetEmTalk\Component\Domain\Chat\Repository;


use LetEmTalk\Component\Domain\Chat\Entity\Room;

interface RoomRepository
{
    public function save(Room $room): void;

    public function getRoom(int $roomId, bool $noCache = false): Room;

    public function getAllRooms(): array;

    public function delete(int $roomId): void;
}