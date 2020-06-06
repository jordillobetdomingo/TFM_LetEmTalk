<?php


namespace LetEmTalk\Component\Domain\Authorization\Service;

use LetEmTalk\Component\Domain\Authorization\Repository\AdminPermissionRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class AdminAuthorization
{
    private AdminPermissionRepository $adminPermissionRepository;
    private UserRepository $userRepository;

    public function __construct(AdminPermissionRepository $adminPermissionRepository, UserRepository $userRepository)
    {
        $this->adminPermissionRepository = $adminPermissionRepository;
        $this->userRepository = $userRepository;
    }

    public function isAdmin(int $userId): bool
    {
        $user = $this->userRepository->getUser($userId);
        if ($user == null) {
            return false;
        }
        $adminPermission = $this->adminPermissionRepository->getAdminPermission($userId);
        if ($adminPermission == null) {
            return false;
        }
        return $adminPermission->getAdminPermission();
    }

}