<?php


namespace LetEmTalk\Component\Domain\Authorization\Repository;


use LetEmTalk\Component\Domain\Authorization\Entity\UserToRoomPermission;
use LetEmTalk\Component\Domain\Chat\Entity\Room;

interface UserToRoomPermissionRepository
{
    public function save(UserToRoomPermission $userToRoomPermission): void;

    public function delete(int $userId, int $roomId): void;

    public function exist(int $userId, int $roomId): bool;

    public function getRoomPermission(int $userId, int $roomId): ?UserToRoomPermission;

    public function getRoomsPermission(int $userId): array;

    public function getUserByManageRoom(Room $room): array;
}