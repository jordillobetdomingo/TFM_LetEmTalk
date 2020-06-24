<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Authorization;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisKey;
use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmTalk\Component\Domain\Authorization\Entity\Role;
use LetEmTalk\Component\Domain\Authorization\Repository\RoleRepository;

class RedisRoleRepository extends RedisRepository implements RoleRepository
{
    const KEY_ROLE_NAME = array("role");
    const KEY_ROLES_NAME = array("roles");
    const KEY_ROLES_VALUE = array("all");

    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        parent::__construct();
        $this->roleRepository = $roleRepository;
    }

    public function getRole(int $roleId, bool $noCache = false): Role
    {
        $key = new RedisKey(self::KEY_ROLE_NAME, $roleId);
        if ($this->exists($key) && !$noCache) {
            return $this->get($key);
        } else {
            $role = $this->roleRepository->getRole($roleId);
            $this->set($key, $role);
            return $role;
        }
    }

    public function getAllRoles(): array
    {
        $key = new RedisKey(self::KEY_ROLES_NAME, self::KEY_ROLES_VALUE);
        if ($this->exists($key)) {
            return $this->get($key);
        } else {
            $roles = $this->roleRepository->getAllRoles();
            $this->set($key, $roles);
            return $roles;
        }
    }
}