<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Authorization;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisKey;
use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmTalk\Component\Domain\Authorization\Entity\AdminPermission;
use LetEmTalk\Component\Domain\Authorization\Repository\AdminPermissionRepository;

class RedisAdminPermissionRepository extends RedisRepository implements AdminPermissionRepository
{
    const KEY_ADMIN_NAME = array("adminPermission");

    private AdminPermissionRepository $adminPermissionRepository;

    public function __construct(AdminPermissionRepository $adminPermissionRepository)
    {
        parent::__construct();
        $this->adminPermissionRepository = $adminPermissionRepository;
    }

    public function getAdminPermission(int $userId): ?AdminPermission
    {
        $key = new RedisKey(self::KEY_ADMIN_NAME, array($userId));
        if ($this->exists($key)) {
            return $this->get($key);
        } else {
            $adminPermission = $this->adminPermissionRepository->getAdminPermission($userId);
            $this->set($key, $adminPermission);
            return $adminPermission;
        }
    }
}