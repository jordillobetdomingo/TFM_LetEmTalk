<?php


namespace LetEmTalk\Component\Domain\Authorization\Repository;


use LetEmTalk\Component\Domain\Authorization\Entity\Role;

interface RoleRepository
{
    public function getRole(int $roleId): Role;

}