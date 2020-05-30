<?php


namespace LetEmTalk\Component\Domain\User\Repository;


use LetEmTalk\Component\Domain\User\Entity\Role;

interface RoleRepository
{
    public function getRole(int $id): Role;

}