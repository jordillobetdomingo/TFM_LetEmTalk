<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Authorization;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisKey;
use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmTalk\Component\Domain\Authorization\Entity\UserToRoomPermission;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToRoomPermissionRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Room;

class RedisUserToRoomPermissionRepository extends RedisRepository implements UserToRoomPermissionRepository
{
    const KEY_ROOM_PERMISSION_NAMES = array("userRoomPermission", "roomPermission");
    const KEY_ROOM_PERMISSION_MANAGE_USER_BY_ROOM_NAMES = array("manageUserRoomPermission");
    const KEY_ROOM_PERMISSION_BY_USER_NAMES = array("userRoomPermission");

    private UserToRoomPermissionRepository $userToRoomPermissionRepository;

    public function __construct(UserToRoomPermissionRepository $userToRoomPermissionRepository)
    {
        parent::__construct();
        $this->userToRoomPermissionRepository = $userToRoomPermissionRepository;
    }

    public function save(UserToRoomPermission $userToRoomPermission): void
    {
        $this->userToRoomPermissionRepository->save($userToRoomPermission);
        $this->set(
            new RedisKey(
                self::KEY_ROOM_PERMISSION_NAMES,
                array($userToRoomPermission->getUser()->getId(), $userToRoomPermission->getRoom()->getId())
            ),
            $userToRoomPermission
        );
        $this->del(
            new RedisKey(self::KEY_ROOM_PERMISSION_BY_USER_NAMES, array($userToRoomPermission->getUser()->getId()))
        );
        $this->del(
            new RedisKey(
                self::KEY_ROOM_PERMISSION_MANAGE_USER_BY_ROOM_NAMES,
                array($userToRoomPermission->getRoom()->getId())
            )
        );
    }

    public function delete(int $userId, int $roomId): void
    {
        $this->userToRoomPermissionRepository->delete($userId, $roomId);
        $this->del(new RedisKey(self::KEY_ROOM_PERMISSION_NAMES, array($userId, $roomId)));
        $this->del(new RedisKey(self::KEY_ROOM_PERMISSION_BY_USER_NAMES, array($userId)));
        $this->del(new RedisKey(self::KEY_ROOM_PERMISSION_MANAGE_USER_BY_ROOM_NAMES,array($roomId)));
    }

    public function exist(int $userId, int $roomId): bool
    {
        return $this->getRoomPermission($userId, $roomId) != null;
    }

    public function getRoomPermission(int $userId, int $roomId): ?UserToRoomPermission
    {
        $key = new RedisKey(self::KEY_ROOM_PERMISSION_NAMES, array($userId, $roomId));
        if ($this->exists($key)) {
            return $this->get($key);
        } else {
            $userToRoomPermission = $this->userToRoomPermissionRepository->getRoomPermission($userId, $roomId);
            $this->set($key, $userToRoomPermission);
            return $userToRoomPermission;
        }
    }

    public function getRoomsPermission(int $userId): array
    {
        $key = new RedisKey(self::KEY_ROOM_PERMISSION_BY_USER_NAMES, array($userId));
        if ($this->exists($key)) {
            return $this->get($key);
        } else {
            $roomsPermission = $this->userToRoomPermissionRepository->getRoomsPermission($userId);
            $this->set($key, $roomsPermission);
            return $roomsPermission;
        }
    }

    public function getUserByManageRoom(Room $room): array
    {
        $key = new RedisKey(self::KEY_ROOM_PERMISSION_MANAGE_USER_BY_ROOM_NAMES, array($room->getId()));
        if ($this->exists($key)) {
            return $this->get($key);
        } else {
            $userManagePermission = $this->userToRoomPermissionRepository->getUserByManageRoom($room);
            $this->set($key, $userManagePermission);
            return $userManagePermission;
        }
    }
}