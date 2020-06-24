<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Authorization;


use Doctrine\ORM\EntityRepository;
use LetEmTalk\Component\Domain\Authorization\Repository\AdminPermissionRepository;
use LetEmTalk\Component\Domain\Authorization\Entity\AdminPermission;

class DoctrineAdminPermissionRepository extends EntityRepository implements AdminPermissionRepository
{
    public function getAdminPermission(int $userId): ?AdminPermission
    {
        return $this->findOneBy(["user" => $userId]);
    }
}