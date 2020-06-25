<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Chat;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisKey;
use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;

class RedisRoomRepository extends RedisRepository implements RoomRepository
{
    const KEY_ROOM_NAME = array("room");

    private RoomRepository $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        parent::__construct();
        $this->roomRepository = $roomRepository;
    }

    public function save(Room $room): void
    {
        $this->roomRepository->save($room);
        $this->set(new RedisKey(self::KEY_ROOM_NAME,array($room->getId())), $room);
    }

    public function getRoom(int $roomId): Room
    {
        $key = new RedisKey(self::KEY_ROOM_NAME, array($roomId));
        if($this->exists($key)) {
            return $this->get($key);
        } else {
            $room = $this->roomRepository->getRoom($roomId);
            $this->set($key, $room);
            return $room;
        }
    }

    public function getAllRooms(): array
    {
        return $this->roomRepository->getAllRooms();
    }

    public function delete(int $roomId): void
    {
        $this->del(new RedisKey(self::KEY_ROOM_NAME, array($roomId)));
        $this->roomRepository->delete($roomId);
    }
}