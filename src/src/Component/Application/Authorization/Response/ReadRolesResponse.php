<?php


namespace LetEmTalk\Component\Application\Authorization\Response;


use LetEmTalk\Component\Domain\Authorization\Entity\Role;

class ReadRolesResponse
{
    private array $roles;

    public function __construct(array $roles)
    {
        $this->roles = $roles;
    }

    public function getRolesAsArray(): array
    {
        return array_map(array($this, "getRoleAsArray"), $this->roles);
    }

    private function getRoleAsArray(Role $role): array
    {
        return [
            "id" => $role->getId(),
            "name" => $role->getName(),
            "permissionRoomWrite" => $role->getPermissionRoomWrite(),
            "permissionRoomManage" => $role->getPermissionRoomManage(),
            "permissionIssueRead" => $role->getPermissionIssueRead(),
            "permissionIssueWrite" => $role->getPermissionIssueWrite(),
            "permissionIssueManage" => $role->getPermissionIssueManage(),
            "createRoom" => $role->getCreateRoom()
        ];
    }
}