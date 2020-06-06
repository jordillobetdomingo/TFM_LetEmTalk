<?php


namespace LetEmTalk\Component\Domain\Authorization\Repository;


use LetEmTalk\Component\Domain\Authorization\Entity\AdminPermission;

interface AdminPermissionRepository
{
    public function getAdminPermission(int $userId): ?AdminPermission;
}