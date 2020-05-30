<?php


namespace LetEmTalk\Component\Domain\Authorization\Entity;


use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\User\Entity\User;

class UserToRoomPermission
{
    private User $user;
    private Room $room;
    private bool $permissionWrite;
    private bool $permissionManage;
}