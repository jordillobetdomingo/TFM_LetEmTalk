<?php


namespace LetEmTalk\Component\Domain\Authorization\Repository;


use LetEmTalk\Component\Domain\User\Entity\Role;

interface RoleRepository
{
    public function getRole(int $id): Role;

}