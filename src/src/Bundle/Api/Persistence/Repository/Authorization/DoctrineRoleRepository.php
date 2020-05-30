<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Authorization;


use Doctrine\ORM\EntityRepository;
use LetEmTalk\Component\Domain\Authorization\Repository\RoleRepository;
use LetEmTalk\Component\Domain\Authorization\Entity\Role;

class DoctrineRoleRepository extends EntityRepository implements RoleRepository
{

    public function getRole(int $roleId): Role
    {
        return $this->findOneBy(["id" => $roleId]);
    }
}