<?php


namespace LetEmTalk\Component\Domain\User\Entity;


class Role
{
    private int $id;
    private string $name;
    private bool $permissionRoomWrite;
    private bool $permissionRoomManage;
    private bool $permissionIssueRead;
    private bool $permissionIssueWrite;
    private bool $permissionIssueManage;
    private bool $createRoom;

    public function getPermissionRoomWrite(): bool
    {
        return $this->permissionRoomWrite;
    }

    public function getPermissionRoomManage(): bool
    {
        return $this->permissionRoomManage;
    }
}