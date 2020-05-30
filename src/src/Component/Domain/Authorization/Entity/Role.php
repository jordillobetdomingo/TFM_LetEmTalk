<?php


namespace LetEmTalk\Component\Domain\Authorization\Entity;


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

    public function getPermissionIssueRead(): bool
    {
        return $this->permissionIssueRead;
    }

    public function getPermissionIssueWrite(): bool
    {
        return $this->permissionIssueWrite;
    }

    public function getPermissionIssueManage(): bool
    {
        return $this->permissionIssueManage;
    }
}