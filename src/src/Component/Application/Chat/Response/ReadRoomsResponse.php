<?php


namespace LetEmTalk\Component\Application\Chat\Response;


use LetEmTalk\Component\Domain\Chat\Entity\Room;

class ReadRoomsResponse
{
    const FIELD_ROOM_ID = "roomId";
    const FIELD_ROOM_USER_ID = "userId";
    const FIELD_ROOM_USER_FIRST_NAME  = "firstName";
    const FIELD_ROOM_USER_LAST_NAME = "lastName";

    private array $rooms;

    public function __construct(array $rooms)
    {
        $this->rooms = $rooms;
    }

    public function getRoomsAsArray(): array
    {
        return array_map(array($this, "getRoomAsArray"), $this->rooms);
    }

    private function getRoomAsArray(Room $room): array
    {
        return [
          self::FIELD_ROOM_ID => $room->getId(),
          self::FIELD_ROOM_USER_ID => $room->getUser()->getId(),
          self::FIELD_ROOM_USER_FIRST_NAME => $room->getUser()->getFirstName(),
          self::FIELD_ROOM_USER_LAST_NAME => $room->getUser()->getLastName()
        ];
    }
}