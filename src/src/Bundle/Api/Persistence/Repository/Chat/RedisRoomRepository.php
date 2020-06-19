<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Chat;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;

class RedisRoomRepository extends RedisRepository implements RoomRepository
{
    const KEY_ROOM = "room:";

    private RoomRepository $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        parent::__construct();
        $this->roomRepository = $roomRepository;
    }

    protected function getKey(int $id): string
    {
        return self::KEY_ROOM . strval($id);
    }

    public function save(Room $room): void
    {
        $this->roomRepository->save($room);
        $this->set($room->getId(), $room);
    }

    public function getRoom(int $roomId): Room
    {
        if($this->exists($roomId)) {
            return $this->get($roomId);
        } else {
            $room = $this->roomRepository->getRoom($roomId);
            $this->set($roomId, $room);
            return $room;
        }
    }

    public function getAllRooms(): array
    {
        return $this->roomRepository->getAllRooms();
    }

    public function delete(int $roomId): void
    {
        $this->del($roomId);
        $this->roomRepository->delete($roomId);
    }
}