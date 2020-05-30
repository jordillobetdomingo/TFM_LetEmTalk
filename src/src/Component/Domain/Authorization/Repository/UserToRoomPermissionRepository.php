<?php


namespace LetEmTalk\Component\Domain\Authorization\Repository;


use LetEmTalk\Component\Domain\Authorization\Entity\UserToRoomPermission;

interface UserToRoomPermissionRepository
{
    public function save(UserToRoomPermission $userToRoomPermission): void;

    public function delete(int $userId, int $roomId): void;

}